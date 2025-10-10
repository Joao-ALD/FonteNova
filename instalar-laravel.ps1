# Requires -Version 5.1
# ------------------------------------------------
# Utilitário para projetos Laravel (Windows PowerShell)
# - Não requer permissão de administrador
# - Execute a partir da pasta raiz do projeto (onde há 'artisan' e 'composer.json')
# ------------------------------------------------

# Codificação de console para UTF-8 (evita "Ã§/Ã£/Ã³")
try { chcp.com 65001 > $null } catch { }
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8

Clear-Host
Write-Host "=====================================" -ForegroundColor Cyan
Write-Host "      UTILITÁRIO PROJETO LARAVEL     " -ForegroundColor Cyan
Write-Host "=====================================" -ForegroundColor Cyan

# Garante execução a partir do diretório do script
try {
    $scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
    if ($scriptDir -and (Test-Path $scriptDir)) { Set-Location $scriptDir }
}
catch { }

# ---------- Utilitários de ambiente ----------
function Teste-Comando {
    param([Parameter(Mandatory = $true)][string]$Nome)
    return bool
}

function Caminho-Comando {
    param([Parameter(Mandatory = $true)][string]$Nome)
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
    if (-not (Teste-Comando "php")) { throw "PHP não encontrado no PATH." }
    if (-not (Teste-Comando "composer")) { throw "Composer não encontrado no PATH." }
}

function Ler-Segredo([string]$prompt) {
    $secure = Read-Host $prompt -AsSecureString
    $bstr = [Runtime.InteropServices.Marshal]::SecureStringToBSTR($secure)
    $plain = [Runtime.InteropServices.Marshal]::PtrToStringBSTR($bstr)
    [Runtime.InteropServices.Marshal]::ZeroFreeBSTR($bstr)
    return $plain
}

# ---------- I/O resiliente para o .env ----------
Add-Type -AssemblyName System.IO
Add-Type -AssemblyName System.Text

function Read-TextShared {
    param([Parameter(Mandatory = $true)][string]$Path)
    if (-not (Test-Path $Path)) { return "" }
    $fs = $null
    try {
        $fs = New-Object System.IO.FileStream($Path, [System.IO.FileMode]::Open, [System.IO.FileAccess]::Read, [System.IO.FileShare]::ReadWrite)
        $sr = New-Object System.IO.StreamReader($fs, [System.Text.Encoding]::UTF8, $true)
        $text = $sr.ReadToEnd()
        $sr.Close()
        return $text
    }
    catch {
        return (Get-Content -Path $Path -Raw -ErrorAction SilentlyContinue)
    }
    finally {
        if ($fs) { $fs.Dispose() }
    }
}

function Write-TextSafe {
    param(
        [Parameter(Mandatory = $true)][string]$Path,
        [Parameter(Mandatory = $true)][string]$Text
    )

    $dir = Split-Path -Parent $Path
    if (-not (Test-Path $dir)) { New-Item -Path $dir -ItemType Directory | Out-Null }

    # Arquivo temporário no mesmo diretório (mesmo volume)
    $temp = Join-Path $dir (".tmp-" + [guid]::NewGuid().ToString("N"))
    $backup = "$Path.bak"
    $encoding = New-Object System.Text.UTF8Encoding($false)  # UTF-8 sem BOM
    [System.IO.File]::WriteAllText($temp, $Text, $encoding)

    if (-not (Test-Path $Path)) { New-Item $Path -ItemType File -Force | Out-Null }

    # Retries maiores se for OneDrive
    $isOneDrive = ($Path -match "(?i)OneDrive")
    $maxRetries = 10
    $delayMs = 500
    if ($isOneDrive) { $maxRetries = 20; $delayMs = 1000 }

    $ok = $false
    for ($i = 1; $i -le $maxRetries; $i++) {
        try {
            [System.IO.File]::Replace($temp, $Path, $backup, $true)
            $ok = $true
            break
        }
        catch {
            Start-Sleep -Milliseconds $delayMs
        }
    }

    if (-not $ok) {
        $pending = "$Path.pending"
        try {
            if (Test-Path $pending) { Remove-Item $pending -Force -ErrorAction SilentlyContinue }
            [System.IO.File]::Move($temp, $pending)
        }
        catch {
            Copy-Item $temp $pending -Force -ErrorAction SilentlyContinue
            Remove-Item $temp -Force -ErrorAction SilentlyContinue
        }
        throw "Não consegui atualizar '$Path' (arquivo possivelmente bloqueado). As alterações foram salvas em '$pending'. Feche editores/sincronizadores e use o menu para aplicar depois."
    }
    else {
        Remove-Item $backup -Force -ErrorAction SilentlyContinue
    }
}

function Set-EnvValores {
    param(
        [Parameter(Mandatory = $true)][hashtable]$Pares,
        [string]$Caminho = ".env"
    )
    $conteudo = Read-TextShared -Path $Caminho
    if ($null -eq $conteudo) { $conteudo = "" }

    foreach ($k in $Pares.Keys) {
        $v = [string]$Pares[$k]
        $padrao = "^(?i)\s*$([regex]::Escape($k))\s*=.*$"
        if ($conteudo -match $padrao) {
            $conteudo = [regex]::Replace($conteudo, $padrao, "$k=$v", 'Multiline')
        }
        else {
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
            $src = Get-Content -Path ".env.example" -Raw -ErrorAction SilentlyContinue
            if ($null -eq $src) { $src = "" }
            Write-TextSafe -Path ".env" -Text $src
            Write-Host "Arquivo .env copiado de .env.example." -ForegroundColor Green
        }
        else {
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

    # Mostra caminho do mysql se houver
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
            $db_host = Read-Host "Host do MySQL (padrão: 127.0.0.1)"; if ([string]::IsNullOrWhiteSpace($db_host)) { $db_host = "127.0.0.1" }
            $db_port = Read-Host "Porta do MySQL (padrão: 3306)"; if ([string]::IsNullOrWhiteSpace($db_port)) { $db_port = "3306" }
            $db_name = Read-Host "Nome do banco de dados"
            $db_user = Read-Host "Usuário do MySQL"
            $db_pass = Ler-Segredo "Senha do MySQL (pode deixar vazio)"

            if (Teste-Comando "mysql") {
                Write-Host "Criando banco de dados (se não existir)..." -ForegroundColor Yellow

                # Monta SQL com crase segura via [char]96
                $bt = [char]96
                $sql = "CREATE DATABASE IF NOT EXISTS $bt$db_name$bt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

                $args = @("--host=$db_host", "--port=$db_port", "--user=$db_user", "-e", $sql)
                if ($db_pass -eq "") {
                    $args += "--skip-password"    # NÃO pede prompt
                }
                else {
                    $args += "--password=$db_pass"
                }

                & mysql @args
                if ($LASTEXITCODE -ne 0) {
                    Write-Host "Aviso: Não foi possível criar o banco automaticamente. Crie manualmente ou verifique credenciais." -ForegroundColor Yellow
                }
                else {
                    Write-Host "Banco verificado/criado." -ForegroundColor Green
                }
            }
            else {
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
            $sqlitePath = (Resolve-Path ".\database").Path + "\database.sqlite"
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

    $url = "http://${bindHost}:$porta"

    Write-Host "Iniciando servidor Laravel em $url..." -ForegroundColor Cyan
    Start-Process -FilePath "php" -ArgumentList @("artisan", "serve", "--host=$bindHost", "--port=$porta") -WindowStyle Normal
    Start-Sleep -Seconds 1
    Start-Process $url
    Write-Host "Servidor iniciado em nova janela." -ForegroundColor Green
}


function A_Frontend {
    if (-not (Teste-Comando "node")) { Write-Host "Node.js não encontrado; pulando." -ForegroundColor Yellow; return }
    if (-not (Teste-Comando "npm")) { Write-Host "npm não encontrado; pulando." -ForegroundColor Yellow; return }

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
        $conteudo = Get-Content -Path $pending -Raw -ErrorAction Stop
        Write-TextSafe -Path ".env" -Text $conteudo
        Remove-Item $pending -Force -ErrorAction SilentlyContinue
        Write-Host "Pendências aplicadas ao .env com sucesso." -ForegroundColor Green
    }
    catch {
        Write-Host "Falha ao aplicar pendências: $($_.Exception.Message)" -ForegroundColor Red
    }
}

function A_InstalacaoCompleta {
    A_AtualizarDependencias
    A_InstalarDependencias
    A_ConfigurarEnvBanco
    A_GerarChave
    A_StorageLink
    A_OptimizeClear
    A_Migrar
    A_Servir
}

# ---------- Loop do Menu ----------
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
        Write-Host "10) Executar tudo (instalação completa)"
        Write-Host "11) Aplicar pendências do .env (se houver)"
        Write-Host "0) Sair"
        Write-Host "=====================================" -ForegroundColor Cyan

        $opcao = Read-Host "Escolha uma opção"
        switch ($opcao) {
            "1" { A_InstalarDependencias }
            "2" { A_AtualizarDependencias }
            "3" { A_ConfigurarEnvBanco }
            "4" { A_GerarChave }
            "5" { A_Migrar }
            "6" { A_StorageLink }
            "7" { A_OptimizeClear }
            "8" { A_Servir }
            "9" { A_Frontend }
            "10" { A_InstalacaoCompleta }
            "11" { A_AplicarEnvPendencias }
            "0" { Write-Host "Saindo..." -ForegroundColor Gray; break }
            default { Write-Host "Opção inválida." -ForegroundColor Red }
        }
    }
    catch {
        Write-Host "`nErro: $($_.Exception.Message)" -ForegroundColor Red
    }
}