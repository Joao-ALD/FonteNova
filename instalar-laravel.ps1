# Requires -Version 5.1

# ------------------------------------------------
# Utilitário para projetos Laravel (Windows PowerShell)
# - Não requer permissão de administrador
# - Execute a partir da pasta raiz do projeto (onde há 'artisan' e 'composer.json')
# ------------------------------------------------

# --- Preferências globais ---
$ErrorActionPreference = 'Stop'

# --- Console UTF-8 (PS 5.1) ---
try { chcp.com 65001 > $null } catch { }
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8

# --- Auto-correção do próprio script (idempotente) ---
function SelfHeal-Script {
    param([Parameter(Mandatory=$true)][string]$Path)

    # Nota: Removido o bloco de reinicialização para simplificar. 
    # O script assume que está em UTF8 e no diretório correto.
    try {
        if (-not (Test-Path $Path)) { return }

        $original = Get-Content -Path $Path -Raw -ErrorAction Stop
        $fixed = $original

        # 1) Remover Add-Type desnecessários (podem causar erro em PS 5.1)
        $fixed = [regex]::Replace(
            $fixed,
            '^\s*Add-Type\s+-AssemblyName\s+System\.(?:IO|Text)\s*\r?\n',
            '',
            'Multiline'
        )

        # 2) Corrigir "$host:" (colide com var automática $host) -> usar ${host}
        $fixed = $fixed -replace 'http://\$host:', 'http://${host}:'
        $fixed = $fixed -replace 'https://\$host:', 'https://${host}:'

        # 2.1) Corrigir 'return bool' na função Teste-Comando
        $fixed = [regex]::Replace($fixed, 'return\s+bool\b', 'return [bool](Get-Command $Nome -ErrorAction SilentlyContinue)')

        # 3) Desescapar "&amp;" (cópias vindas de HTML quebram "& cmd")
        $fixed = $fixed -replace '&amp;', '&'

        # 4) Normalizar quebras de linha para CRLF (Windows) – opcional, mas ajuda
        $fixed = $fixed -replace "(\r?\n)", "`r`n"

        if ($fixed -ne $original) {
            # Salva como UTF-8 COM BOM (em PS 5.1, -Encoding UTF8 grava com BOM)
            Set-Content -Path $Path -Value $fixed -Encoding UTF8
            Write-Host "[auto] Script ajustado (Add-Type/host/return bool/&). Por favor, reinicie o script." -ForegroundColor Yellow
            
            # Não reinicia, apenas exibe a mensagem e encerra
            exit 
        }
    } catch {
        Write-Host "[auto] Aviso ao tentar auto-corrigir: $($_.Exception.Message)" -ForegroundColor DarkYellow
        # Segue mesmo assim
    }
}
# Garante execução do SelfHeal-Script uma única vez no início
try {
    $scriptPath = $MyInvocation.MyCommand.Path
    if ($scriptPath) {
        SelfHeal-Script -Path $scriptPath
    }
} catch { }


# ---------- Utilitários de ambiente ----------
function Teste-Comando {
    param([Parameter(Mandatory=$true)][string]$Nome)
    # Retorna $true se o comando for encontrado, $false caso contrário.
    return [bool](Get-Command $Nome -ErrorAction SilentlyContinue)
}
function Caminho-Comando {
    param([Parameter(Mandatory=$true)][string]$Nome)
    $cmd = Get-Command $Nome -ErrorAction SilentlyContinue
    if ($cmd) { return $cmd.Path } else { return $null }
}
function Exigir-ArquivosProjeto {
    if (-not (Test-Path ".\artisan")) {
        throw "Arquivo 'artisan' não encontrado. Rode este script na raiz do projeto Laravel."
    }
    if (-not (Test-Path ".\composer.json")) {
        throw "Arquivo 'composer.json' não encontrado. Rode este script na raiz do projeto Laravel."
    }
}
function Checar-Basicos {
    Exigir-ArquivosProjeto
    if (-not (Teste-Comando "php"))      { throw "PHP não encontrado no PATH." }
    if (-not (Teste-Comando "composer")) { throw "Composer não encontrado no PATH." }

    # Garante que o diretório de cache do Laravel exista para evitar erros no composer install/update
    $cacheDir = ".\bootstrap\cache"
    if (-not (Test-Path $cacheDir)) {
        Write-Host "Diretório '$cacheDir' não encontrado. Criando automaticamente..." -ForegroundColor Yellow
        New-Item -Path $cacheDir -ItemType Directory -Force | Out-Null
    }
}
function Ler-Segredo([string]$prompt) {
    $secure = Read-Host $prompt -AsSecureString
    $bstr = [Runtime.InteropServices.Marshal]::SecureStringToBSTR($secure)
    $plain = [Runtime.InteropServices.Marshal]::PtrToStringBSTR($bstr)
    [Runtime.InteropServices.Marshal]::ZeroFreeBSTR($bstr)
    return $plain
}

# ---------- I/O resiliente para o .env ----------
function Read-TextShared {
    param([Parameter(Mandatory=$true)][string]$Path)
    if (-not (Test-Path $Path)) { return "" }
    $fs = $null
    try {
        $fs = New-Object System.IO.FileStream($Path, [System.IO.FileMode]::Open, [System.IO.FileAccess]::Read, [System.IO.FileShare]::ReadWrite)
        $sr = New-Object System.IO.StreamReader($fs, [System.Text.Encoding]::UTF8, $true)
        $text = $sr.ReadToEnd()
        $sr.Close()
        return $text
    } catch {
        # Fallback para Get-Content caso a leitura compartilhada falhe
        return (Get-Content -Path $Path -Raw -ErrorAction SilentlyContinue)
    } finally {
        if ($fs) { $fs.Dispose() }
    }
}
function Write-TextSafe {
    param(
        [Parameter(Mandatory=$true)][string]$Path,
        [Parameter(Mandatory=$true)][string]$Text
    )

    $dir = Split-Path -Parent $Path
    
    # ESTA VALIDAÇÃO É A CORREÇÃO. Ela impede a execução de New-Item com um caminho vazio.
    if (-not ([string]::IsNullOrEmpty($dir)) -and -not (Test-Path $dir)) { 
        New-Item -Path $dir -ItemType Directory | Out-Null 
    }

    $temp   = Join-Path $dir (".tmp-" + [guid]::NewGuid().ToString("N"))
    $backup = "$Path.bak"
    $encoding = New-Object System.Text.UTF8Encoding($false)  # UTF-8 sem BOM
    
    # GARANTE que o caminho temporário não seja vazio
    if ([string]::IsNullOrWhiteSpace($temp)) {
        throw "Caminho temporário vazio. Verifique o caminho de destino: '$Path'"
    }
    
    [System.IO.File]::WriteAllText($temp, $Text, $encoding)

    if (-not (Test-Path $Path)) { New-Item $Path -ItemType File -Force | Out-Null }

    # Retries maiores se for OneDrive
    $isOneDrive = ($Path -match "(?i)OneDrive")
    $maxRetries = 10; $delayMs = 500
    if ($isOneDrive) { $maxRetries = 20; $delayMs = 1000 }

    $ok = $false
    for ($i=1; $i -le $maxRetries; $i++) {
        try {
            # Se $temp ou $Path for nulo/vazio aqui, falha com o erro 'cadeia de caracteres vazia'
            [System.IO.File]::Replace($temp, $Path, $backup, $true)
            $ok = $true; break
        } catch {
            Start-Sleep -Milliseconds $delayMs
        }
    }

    if (-not $ok) {
        $pending = "$Path.pending"
        try {
            if (Test-Path $pending) { Remove-Item $pending -Force -ErrorAction SilentlyContinue }
            [System.IO.File]::Move($temp, $pending)
        } catch {
            Copy-Item $temp $pending -Force -ErrorAction SilentlyContinue
            Remove-Item $temp -Force -ErrorAction SilentlyContinue
        }
        throw "Não consegui atualizar '$Path' (arquivo possivelmente bloqueado). As alterações foram salvas em '$pending'. Feche editores/sincronizadores e use o menu para aplicar depois."
    } else {
        Remove-Item $backup -Force -ErrorAction Silentlycontinue
    }
}
function Set-EnvValores {
    param(
        [Parameter(Mandatory=$true)][hashtable]$Pares,
        [string]$Caminho=".env"
    )
    $conteudo = Read-TextShared -Path $Caminho
    if ($null -eq $conteudo) { $conteudo = "" }

    foreach ($k in $Pares.Keys) {
        $v = [string]$Pares[$k]
        $padrao = "^(?i)\s*$([regex]::Escape($k))\s*=.*$"
        if ($conteudo -match $padrao) {
            $conteudo = [regex]::Replace($conteudo, $padrao, "$k=$v", 'Multiline')
        } else {
            if ($conteudo -and -not $conteudo.EndsWith("`n")) { $conteudo += "`n" }
            $conteudo += "$k=$v"
        }
        if (-not $conteudo.EndsWith("`n")) { $conteudo += "`n" }
    }

    Write-TextSafe -Path $Caminho -Text $conteudo
}
function Criar-EnvSeNecessario {
    if (-not (Test-Path ".env")) {
        if (Test-Path ".env.example") {
            $src = Read-TextShared -Path ".env.example"
            if ($null -eq $src) { $src = "" }
            Write-TextSafe -Path ".env" -Text $src
            Write-Host "Arquivo .env copiado de .env.example." -ForegroundColor Green
        } else {
            Write-TextSafe -Path ".env" -Text ""
            Write-Host "Arquivo .env criado (vazio)." -ForegroundColor Yellow
        }
    }
}


# ---------- Ações ----------
function A_InstalarDependencias {
    Checar-Basicos
    Write-Host "`nInstalando dependências (composer install)..." -ForegroundColor Cyan
    $env:COMPOSER_MEMORY_LIMIT = "-1"
    composer install --no-interaction
    if ($LASTEXITCODE -ne 0) { throw "Falha ao instalar dependências." }
}
function A_AtualizarDependencias {
    Checar-Basicos
    Write-Host "`nAtualizando dependências (composer update)..." -ForegroundColor Cyan
    $env:COMPOSER_MEMORY_LIMIT = "-1"
    composer update --no-interaction
    if ($LASTEXITCODE -ne 0) { throw "Falha ao atualizar dependências." }
}
function A_ConfigurarEnvBanco {
    Checar-Basicos
    Criar-EnvSeNecessario

    if (Teste-Comando "mysql") {
        $mx = Caminho-Comando "mysql"
        if ($mx) { Write-Host ("MySQL detectado em: " + $mx) -ForegroundColor DarkGray }
    }

    Write-Host "`nSelecione o driver de banco para configurar no .env:" -ForegroundColor Cyan
    Write-Host "1) MySQL/MariaDB"
    Write-Host "2) SQLite (recomendado para dev simples, sem MySQL)"
    $op = Read-Host "Opção (1-2)"
    switch ($op) {
        "1" {
            $db_host = Read-Host "Host do MySQL (padrão: 127.0.0.1)"; if ([string]::IsNullOrWhiteSpace($db_host)) { $db_host="127.0.0.1" }
            $db_port = Read-Host "Porta do MySQL (padrão: 3306)"; if ([string]::IsNullOrWhiteSpace($db_port)) { $db_port="3306" }
            $db_name = Read-Host "Nome do banco de dados"
            $db_user = Read-Host "Usuário do MySQL"
            $db_pass = Ler-Segredo "Senha do MySQL (pode deixar vazio)"

            if (Teste-Comando "mysql") {
                Write-Host "Criando banco de dados (se não existir)..." -ForegroundColor Yellow

                $bt = [char]96
                $sql = "CREATE DATABASE IF NOT EXISTS $bt$db_name$bt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

                $args = @("--host=$db_host","--port=$db_port","--user=$db_user","-e",$sql)
                if ($db_pass -eq "") { $args += "--skip-password" } else { $args += "--password=$db_pass" }

                & mysql @args
                if ($LASTEXITCODE -ne 0) {
                    Write-Host "Aviso: Não foi possível criar o banco automaticamente. Crie manualmente ou verifique credenciais." -ForegroundColor Yellow
                } else {
                    Write-Host "Banco verificado/criado." -ForegroundColor Green
                }
            } else {
                Write-Host "Comando 'mysql' não está no PATH; pulando criação automática do DB." -ForegroundColor Yellow
            }

            Set-EnvValores @{
                "DB_CONNECTION" = "mysql"
                "DB_HOST"       = $db_host
                "DB_PORT"       = $db_port
                "DB_DATABASE"   = $db_name
                "DB_USERNAME"   = $db_user
                "DB_PASSWORD"   = $db_pass
            }
            Write-Host "Arquivo .env atualizado para MySQL." -ForegroundColor Green
        }
        "2" {
            if (-not (Test-Path ".\database")) { New-Item ".\database" -ItemType Directory | Out-Null }
            $sqlitePath = Join-Path -Path (Resolve-Path ".\database").Path -ChildPath "database.sqlite"
            if (-not (Test-Path $sqlitePath)) { New-Item $sqlitePath -ItemType File | Out-Null }

            Set-EnvValores @{
                "DB_CONNECTION" = "sqlite"
                "DB_DATABASE"   = $sqlitePath
                "DB_HOST"       = ""
                "DB_PORT"       = ""
                "DB_USERNAME"   = ""
                "DB_PASSWORD"   = ""
            }
            Write-Host "Arquivo .env atualizado para SQLite: $sqlitePath" -ForegroundColor Green
        }
        default {
            Write-Host "Opção inválida." -ForegroundColor Red
        }
    }
}
function A_GerarChave {
    Checar-Basicos
    Criar-EnvSeNecessario
    Write-Host "`nGerando APP_KEY..." -ForegroundColor Cyan
    php artisan key:generate
    if ($LASTEXITCODE -ne 0) { throw "Falha ao gerar chave da aplicação." }
}
function A_Migrar {
    Checar-Basicos
    Write-Host "`nDeseja rodar com --seed? (S/N)" -NoNewline
    $withSeed = (Read-Host).Trim().ToUpper() -eq "S"
    $args = @("migrate")
    if ($withSeed) { $args += "--seed" }
    Write-Host "Executando: php artisan $($args -join ' ')" -ForegroundColor Cyan
    php artisan @args
    if ($LASTEXITCODE -ne 0) { throw "Falha ao executar migrations." }
}
function A_StorageLink {
    Checar-Basicos
    Write-Host "`nCriando link de storage..." -ForegroundColor Cyan
    php artisan storage:link
    if ($LASTEXITCODE -ne 0) { throw "Falha ao criar storage:link." }
}
function A_OptimizeClear {
    Checar-Basicos
    Write-Host "`nLimpando caches (optimize:clear)..." -ForegroundColor Cyan
    php artisan optimize:clear
    if ($LASTEXITCODE -ne 0) { throw "Falha ao limpar caches." }
}
function Porta-Disponivel {
    param([int]$inicio = 8000)
    $p = $inicio
    while (Test-NetConnection -ComputerName '127.0.0.1' -Port $p -InformationLevel Quiet) {
        $p++
    }
    return $p
}
function A_Servir {
    Checar-Basicos

    $bindHost = Read-Host "Host (padrão: 127.0.0.1)"; if ([string]::IsNullOrWhiteSpace($bindHost)) { $bindHost = "127.0.0.1" }
    $portaDesejada = Read-Host "Porta (padrão: 8000)"; if ([string]::IsNullOrWhiteSpace($portaDesejada)) { $portaDesejada = "8000" }

    $portaDesejadaInt = [int]$portaDesejada
    $porta = Porta-Disponivel -inicio $portaDesejadaInt
    if ($porta -ne $portaDesejadaInt) {
        Write-Host "Porta $portaDesejadaInt ocupada. Usando porta livre $porta." -ForegroundColor Yellow
    }

    # Evita ambiguidade com ":" usando formato composto
    $url = 'http://{0}:{1}' -f $bindHost, $porta

    Write-Host "Iniciando servidor Laravel em $url..." -ForegroundColor Cyan
    Start-Process -FilePath "php" -ArgumentList @("artisan","serve","--host=$bindHost","--port=$porta") -WindowStyle Normal
    Start-Sleep -Seconds 1
    Start-Process $url
    Write-Host "Servidor iniciado em nova janela." -ForegroundColor Green
}
function A_Frontend {
    if (-not (Teste-Comando "node")) { Write-Host "Node.js não encontrado; pulando." -ForegroundColor Yellow; return }
    if (-not (Teste-Comando "npm"))  { Write-Host "npm não encontrado; pulando." -ForegroundColor Yellow; return }

    Write-Host "`nOpções frontend:" -ForegroundColor Cyan
    Write-Host "1) npm install"
    Write-Host "2) npm run dev"
    Write-Host "3) npm run build"
    Write-Host "0) Voltar"
    $o = Read-Host "Opção"
    switch ($o) {
        "1" { npm install; if ($LASTEXITCODE -ne 0) { throw "Falha no 'npm install'." } }
        "2" { npm run dev }
        "3" { npm run build; if ($LASTEXITCODE -ne 0) { throw "Falha no 'npm run build'." } }
        "0" { return }
        default { Write-Host "Opção inválida." -ForegroundColor Red }
    }
}
function A_AplicarEnvPendencias {
    $pending = ".env.pending"
    if (-not (Test-Path $pending)) {
        Write-Host "Nenhuma pendência encontrada ($pending)." -ForegroundColor Yellow
        return
    }
    try {
        $conteudo = Read-TextShared -Path $pending
        Write-TextSafe -Path ".env" -Text $conteudo
        Remove-Item $pending -Force -ErrorAction SilentlyContinue
        Write-Host "Pendências aplicadas ao .env com sucesso." -ForegroundColor Green
    } catch {
        Write-Host "Falha ao aplicar pendências: $($_.Exception.Message)" -ForegroundColor Red
    }
}

# --- FUNÇÃO PRINCIPAL MODIFICADA ---
function A_InstalacaoCompleta {
    Write-Host "`n--- Iniciando Instalação Completa e Automática ---" -ForegroundColor Magenta
    
    # Etapa 1: Dependências do Composer
    Write-Host "`n[1/5] Instalando dependências do Composer..." -ForegroundColor Cyan
    A_AtualizarDependencias
    A_InstalarDependencias
    
    # Etapa 2: Criação do .env e Geração da Chave
    Write-Host "`n[2/5] Configurando arquivo de ambiente (.env) e chave da aplicação..." -ForegroundColor Cyan
    Criar-EnvSeNecessario
    A_GerarChave
    
    # Etapa 3: Configuração do Banco de Dados (Interativo)
    Write-Host "`n[3/5] Agora, vamos configurar o acesso ao banco de dados." -ForegroundColor Cyan
    A_ConfigurarEnvBanco # Reutiliza a lógica do menu 3 para pedir os dados
    
    # Etapa 4: Migrations e Seeders (com confirmação)
    Write-Host "`n[4/5] Deseja executar as migrations e popular o banco (php artisan migrate --seed)? (S/N)" -NoNewline
    $rodarMigrate = (Read-Host).Trim().ToUpper()
    if ($rodarMigrate -eq "S") {
        Write-Host "Executando 'php artisan migrate --seed'..." -ForegroundColor Cyan
        php artisan migrate --seed
        if ($LASTEXITCODE -ne 0) {
            Write-Host "Aviso: Falha ao executar as migrations. Verifique as credenciais do banco no .env." -ForegroundColor Yellow
        } else {
            Write-Host "Migrations e seeders executados com sucesso." -ForegroundColor Green
        }
    } else {
        Write-Host "Migrations puladas. Você pode executá-las manualmente com a opção 5." -ForegroundColor Yellow
    }

    # Etapa 5: Finalização
    Write-Host "`n[5/5] Executando tarefas finais (storage:link, optimize:clear)..." -ForegroundColor Cyan
    A_StorageLink
    A_OptimizeClear

    # Mensagem de Conclusão
    Write-Host "`n==========================================================================" -ForegroundColor Green
    Write-Host "    ✅ PROJETO INSTALADO E CONFIGURADO COM SUCESSO!" -ForegroundColor Green
    Write-Host "    👉 Tudo pronto! Você já pode iniciar o servidor usando a OPÇÃO 8." -ForegroundColor Green
    Write-Host "==========================================================================" -ForegroundColor Green
}

# ---------- UI ----------
Clear-Host
Write-Host "=====================================" -ForegroundColor Cyan
Write-Host "      UTILITÁRIO PROJETO LARAVEL     " -ForegroundColor Cyan
Write-Host "=====================================" -ForegroundColor Cyan

while ($true) {
    try {
        Write-Host ""
        Write-Host "============== MENU =================" -ForegroundColor Cyan
        Write-Host "1) Instalar dependências (composer install)"
        Write-Host "2) Atualizar dependências (composer update)"
        Write-Host "3) Copiar/Configurar .env (MySQL/SQLite)"
        Write-Host "4) Gerar chave da aplicação (key:generate)"
        Write-Host "5) Rodar migrations (opcional --seed)"
        Write-Host "6) Criar storage:link"
        Write-Host "7) Limpar caches (optimize:clear)"
        Write-Host "8) Iniciar servidor (host/porta)"
        Write-Host "9) Frontend (npm install/dev/build) - opcional"
        Write-Host "-------------------------------------"
        Write-Host "10) Executar tudo (Instalação de Código Completa)"
        Write-Host "11) Aplicar pendências do .env (se houver)"
        Write-Host "0) Sair"
        Write-Host "=====================================" -ForegroundColor Cyan

        $opcao = Read-Host "Escolha uma opção"
        switch ($opcao) {
            "1"  { A_InstalarDependencias }
            "2"  { A_AtualizarDependencias }
            "3"  { A_ConfigurarEnvBanco }
            "4"  { A_GerarChave }
            "5"  { A_Migrar }
            "6"  { A_StorageLink }
            "7"  { A_OptimizeClear }
            "8"  { A_Servir }
            "9"  { A_Frontend }
            "10" { A_InstalacaoCompleta }
            "11" { A_AplicarEnvPendencias }
            "0"  { Write-Host "Saindo..." -ForegroundColor Gray; break }
            default { Write-Host "Opção inválida." -ForegroundColor Red }
        }
    }
    catch {
        Write-Host "`nErro: $($_.Exception.Message)" -ForegroundColor Red
    }
}