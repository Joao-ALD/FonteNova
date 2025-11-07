# Requires -Version 5.1

# ------------------------------------------------
# Utilitário para projetos Laravel (Windows PowerShell)
# - Não requer permissão de administrador
# - Execute a partir da pasta raiz do projeto (onde há 'artisan', 'composer.json', etc.)
# ------------------------------------------------

# --- Preferências globais ---
$ErrorActionPreference = 'Stop'

# --- Garante que o console use UTF-8 (essencial para acentos e caracteres especiais) ---
try { chcp.com 65001 > $null } catch { }
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8

# --- Auto-correção do próprio script (idempotente) ---
# Esta função verifica e corrige problemas comuns que podem surgir ao copiar/colar o script.
function SelfHeal-Script {
    param([Parameter(Mandatory=$true)][string]$Path)

    try {
        if (-not (Test-Path $Path)) { return }

        $original = Get-Content -Path $Path -Raw -ErrorAction Stop
        $fixed = $original

        # 1) Remover Add-Type desnecessários (podem causar erro em PS 5.1)
        $fixed = [regex]::Replace($fixed, '^\s*Add-Type\s+-AssemblyName\s+System\.(?:IO|Text)\s*\r?\n', '', 'Multiline')

        # 2) Corrigir "$host:" (colide com var automática $host) -> usar ${host}
        $fixed = $fixed -replace 'http://\$host:', 'http://${host}:'
        $fixed = $fixed -replace 'https://\$host:', 'https://${host}:'

        # 3) Desescapar "&" (cópias vindas de HTML quebram chamadas como "& cmd")
        $fixed = $fixed -replace '&', '&'

        # 4) Normalizar quebras de linha para CRLF (padrão Windows)
        $fixed = $fixed -replace "(?<!\r)\n", "`r`n"

        if ($fixed -ne $original) {
            # Salva como UTF-8 COM BOM (padrão do PowerShell 5.1 para -Encoding UTF8)
            Set-Content -Path $Path -Value $fixed -Encoding UTF8
            Write-Host "[AUTO-CORREÇÃO] O script foi ajustado. Por favor, reinicie-o." -ForegroundColor Yellow
            exit
        }
    } catch {
        Write-Host "[AUTO-CORREÇÃO] Aviso ao tentar auto-corrigir: $($_.Exception.Message)" -ForegroundColor DarkYellow
    }
}

# Garante a execução da auto-correção uma única vez no início
try {
    # $MyInvocation.MyCommand.Path só funciona quando o script é executado, não no ISE/VSCode com F5
    if ($MyInvocation.MyCommand.Path) {
        SelfHeal-Script -Path $MyInvocation.MyCommand.Path
    }
} catch { }


# ---------- Utilitários de Ambiente ----------
function Test-CommandExists {
    param([Parameter(Mandatory=$true)][string]$Name)
    # Retorna $true se o comando for encontrado no PATH, $false caso contrário.
    return [bool](Get-Command $Name -ErrorAction SilentlyContinue)
}

function Get-CommandPath {
    param([Parameter(Mandatory=$true)][string]$Name)
    return (Get-Command $Name -ErrorAction SilentlyContinue).Path
}

function Assert-ProjectRoot {
    if (-not (Test-Path ".\artisan") -or -not (Test-Path ".\composer.json")) {
        throw "Este script deve ser executado a partir do diretório raiz de um projeto Laravel (onde 'artisan' e 'composer.json' existem)."
    }
}

function Check-Prerequisites {
    Assert-ProjectRoot
    if (-not (Test-CommandExists "php"))      { throw "Comando 'php' não encontrado no PATH." }
    if (-not (Test-CommandExists "composer")) { throw "Comando 'composer' não encontrado no PATH." }
    if (-not (Test-CommandExists "git"))      { Write-Host "Aviso: Comando 'git' não encontrado no PATH. Algumas funcionalidades podem ser limitadas." -ForegroundColor Yellow }

    # Garante que o diretório de cache do Laravel exista para evitar erros no composer install/update
    $cacheDir = ".\bootstrap\cache"
    if (-not (Test-Path $cacheDir)) {
        Write-Host "Diretório '$cacheDir' não encontrado. Criando automaticamente..." -ForegroundColor Yellow
        New-Item -Path $cacheDir -ItemType Directory -Force | Out-Null
    }
}

function Read-Secret {
    param([string]$Prompt)
    $secure = Read-Host $Prompt -AsSecureString
    $bstr = [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($secure)
    try {
        return [System.Runtime.InteropServices.Marshal]::PtrToStringBSTR($bstr)
    } finally {
        [System.Runtime.InteropServices.Marshal]::ZeroFreeBSTR($bstr)
    }
}


# ---------- I/O Resiliente para Arquivos (.env) ----------
# Lê um arquivo de texto mesmo que ele esteja aberto em outro programa.
function Read-TextShared {
    param([Parameter(Mandatory=$true)][string]$Path)
    if (-not (Test-Path $Path)) { return $null }
    try {
        $fs = New-Object System.IO.FileStream($Path, [System.IO.FileMode]::Open, [System.IO.FileAccess]::Read, [System.IO.FileShare]::ReadWrite)
        $sr = New-Object System.IO.StreamReader($fs, [System.Text.Encoding]::UTF8, $true)
        $text = $sr.ReadToEnd()
        return $text
    } catch {
        # Fallback para o método padrão caso a leitura compartilhada falhe.
        return (Get-Content -Path $Path -Raw -ErrorAction SilentlyContinue)
    } finally {
        if ($sr) { $sr.Dispose() }
        if ($fs) { $fs.Dispose() }
    }
}

# Escreve em um arquivo de forma segura, com retentativas e fallback, ideal para ambientes com OneDrive ou IDEs ativas.
function Write-TextSafe {
    param(
        [Parameter(Mandatory=$true)][string]$Path,
        [Parameter(Mandatory=$true)][string]$Text
    )

    $dir = Split-Path -Parent $Path
    if (-not ([string]::IsNullOrEmpty($dir)) -and -not (Test-Path $dir)) {
        New-Item -Path $dir -ItemType Directory | Out-Null
    }

    $tempPath = Join-Path $dir (".tmp-" + [guid]::NewGuid().ToString("N"))
    $backupPath = "$Path.bak"
    $encoding = New-Object System.Text.UTF8Encoding($false) # UTF-8 sem BOM

    [System.IO.File]::WriteAllText($tempPath, $Text, $encoding)

    $maxRetries = 10; $delayMs = 500
    if ($Path -match "(?i)OneDrive") { $maxRetries = 20; $delayMs = 1000 }

    for ($i = 1; $i -le $maxRetries; $i++) {
        try {
            [System.IO.File]::Replace($tempPath, $Path, $backupPath, $true)
            Remove-Item $backupPath -Force -ErrorAction SilentlyContinue
            return # Sucesso
        } catch {
            Start-Sleep -Milliseconds $delayMs
        }
    }

    # Se todas as tentativas falharem, move o arquivo temporário para .pending
    $pendingPath = "$Path.pending"
    try {
        Move-Item -Path $tempPath -Destination $pendingPath -Force
    } catch {
        # Fallback se até o Move-Item falhar
        Remove-Item -Path $pendingPath -Force -ErrorAction SilentlyContinue
        Copy-Item -Path $tempPath -Destination $pendingPath -Force
        Remove-Item -Path $tempPath -Force
    }
    throw "Não foi possível atualizar '$Path' (arquivo pode estar bloqueado por um editor, antivírus ou sincronizador). As alterações foram salvas em '$pendingPath'. Feche os programas e use a opção 'Aplicar pendências' no menu."
}

# (REVISADO) Atualiza ou adiciona valores no arquivo .env de forma mais limpa.
function Set-EnvValues {
    param(
        [Parameter(Mandatory=$true)][hashtable]$Pairs,
        [string]$Path = ".env"
    )
    $content = Read-TextShared -Path $Path
    if ($null -eq $content) { $content = "" }

    $lines = $content -split '\r?\n'
    $newContent = [System.Collections.Generic.List[string]]::new()
    $keysToUpdate = [System.Collections.Generic.List[string]]::new()
    $Pairs.Keys | ForEach-Object { $keysToUpdate.Add($_) }

    # Atualiza as chaves existentes
    foreach ($line in $lines) {
        $updated = $false
        foreach ($key in $keysToUpdate) {
            if ($line -match "^(?i)\s*$([regex]::Escape($key))\s*=") {
                $newContent.Add("$key=$($Pairs[$key])")
                [void]$keysToUpdate.Remove($key)
                $updated = $true
                break
            }
        }
        if (-not $updated) {
            $newContent.Add($line)
        }
    }

    # Adiciona novas chaves que não existiam
    if ($keysToUpdate.Count -gt 0) {
        if ($newContent.Count -gt 0 -and $newContent[-1].Trim() -ne "") {
            $newContent.Add("") # Adiciona uma linha em branco antes das novas chaves
        }
        foreach ($key in $keysToUpdate) {
            $newContent.Add("$key=$($Pairs[$key])")
        }
    }

    # Garante que termine com uma única quebra de linha
    $finalText = ($newContent -join "`r`n").TrimEnd() + "`r`n"
    Write-TextSafe -Path $Path -Text $finalText
}

function Ensure-EnvFileExists {
    if (-not (Test-Path ".env")) {
        if (Test-Path ".env.example") {
            Copy-Item -Path ".env.example" -Destination ".env"
            Write-Host "Arquivo .env copiado de .env.example." -ForegroundColor Green
        } else {
            Write-TextSafe -Path ".env" -Text ""
            Write-Host "Arquivo .env criado (vazio)." -ForegroundColor Yellow
        }
    }
}


# ---------- Ações do Menu ----------
function A_InstallDependencies {
    Check-Prerequisites
    Write-Host "`nInstalando dependências (composer install)..." -ForegroundColor Cyan
    $env:COMPOSER_MEMORY_LIMIT = "-1"
    composer install --no-interaction --prefer-dist --optimize-autoloader
    if ($LASTEXITCODE -ne 0) { throw "Falha ao executar 'composer install'." }
    Write-Host "Dependências instaladas com sucesso." -ForegroundColor Green
}

function A_UpdateDependencies {
    Check-Prerequisites
    Write-Host "`nAtualizando dependências (composer update)..." -ForegroundColor Cyan
    $env:COMPOSER_MEMORY_LIMIT = "-1"
    composer update --no-interaction
    if ($LASTEXITCODE -ne 0) { throw "Falha ao executar 'composer update'." }
    Write-Host "Dependências atualizadas com sucesso." -ForegroundColor Green
}

function Test-MySQLConnection {
    param(
        [string]$Host,
        [string]$Port,
        [string]$User,
        [string]$Pass
    )
    try {
        $env:MYSQL_PWD = $Pass
        $output = & mysql --host=$Host --port=$Port --user=$User --execute="SELECT 1;" 2>&1
        $success = $LASTEXITCODE -eq 0
        $env:MYSQL_PWD = $null
        return $success
    } catch {
        return $false
    }
}

function A_ConfigureDbEnv {
    Check-Prerequisites
    Ensure-EnvFileExists

    $mysqlAvailable = $false
    $mysqlPath = $null
    if (Test-CommandExists "mysql") {
        $mysqlPath = Get-CommandPath "mysql"
        $mysqlVersion = try { 
            $output = & mysql --version
            if ($output -match 'Ver\s+(\d+\.\d+\.\d+)') {
                $matches[1]
            } else {
                "Versão desconhecida"
            }
        } catch { "Erro ao verificar versão" }
        
        Write-Host "MySQL client detectado:" -ForegroundColor DarkGray
        Write-Host "→ Caminho: $mysqlPath" -ForegroundColor DarkGray
        Write-Host "→ Versão: $mysqlVersion" -ForegroundColor DarkGray
        $mysqlAvailable = $true
    }

    Write-Host "`nSelecione o driver de banco de dados para configurar no .env:" -ForegroundColor Cyan
    Write-Host "1) MySQL / MariaDB" -NoNewline
    if ($mysqlAvailable) { 
        Write-Host " (Cliente instalado)" -ForegroundColor Green 
    } else {
        Write-Host " (Cliente não encontrado)" -ForegroundColor Yellow
    }
    Write-Host "2) SQLite (recomendado para desenvolvimento simples)"
    $option = Read-Host "Opção (1-2)"
    switch ($option) {
        "1" {
            $db_host = Read-Host "Host do MySQL (padrão: 127.0.0.1)"; if ([string]::IsNullOrWhiteSpace($db_host)) { $db_host="127.0.0.1" }
            $db_port = Read-Host "Porta do MySQL (padrão: 3306)"; if ([string]::IsNullOrWhiteSpace($db_port)) { $db_port="3306" }
            $db_name = Read-Host "Nome do banco de dados"
            $db_user = Read-Host "Usuário do MySQL"
            $db_pass = Read-Secret "Senha do MySQL (deixe em branco se não houver)"

            if (Test-CommandExists "mysql") {
                Write-Host "Tentando criar o banco de dados '$db_name' (se não existir)..." -ForegroundColor Yellow
                $backtick = [char]96
                $sql = "CREATE DATABASE IF NOT EXISTS ${backtick}${db_name}${backtick} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
                
                # Para evitar problemas com senhas contendo caracteres especiais, usamos uma variável de ambiente.
                $env:MYSQL_PWD = $db_pass
                try {
                    & mysql --host=$db_host --port=$db_port --user=$db_user -e $sql
                } finally { $env:MYSQL_PWD = $null } # Limpa a variável de ambiente
                if ($LASTEXITCODE -ne 0) {
                    Write-Host "Aviso: Não foi possível criar o banco automaticamente. Verifique as credenciais ou crie-o manualmente." -ForegroundColor Yellow
                } else {
                    Write-Host "Banco de dados verificado/criado com sucesso." -ForegroundColor Green
                }
            } else {
                Write-Host "Comando 'mysql' não encontrado no PATH. Criação automática do banco pulada." -ForegroundColor Yellow
            }

            Set-EnvValues @{
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

            Set-EnvValues @{
                "DB_CONNECTION" = "sqlite"
                "DB_DATABASE"   = $sqlitePath
                "DB_HOST"       = ""
                "DB_PORT"       = ""
                "DB_USERNAME"   = ""
                "DB_PASSWORD"   = ""
            }
            Write-Host "Arquivo .env atualizado para SQLite: $sqlitePath" -ForegroundColor Green
        }
        default { Write-Host "Opção inválida." -ForegroundColor Red }
    }
}

function A_GenerateAppKey {
    Check-Prerequisites
    Ensure-EnvFileExists
    Write-Host "`nGerando chave da aplicação (APP_KEY)..." -ForegroundColor Cyan
    php artisan key:generate
    if ($LASTEXITCODE -ne 0) { throw "Falha ao gerar a chave da aplicação." }
}

function A_RunMigrations {
    Check-Prerequisites
    Write-Host "`nDeseja popular o banco de dados com os seeders (migrate --seed)? (S/N)" -NoNewline
    $withSeed = (Read-Host).Trim().ToUpper() -eq "S"
    
    $args = @("migrate")
    if ($withSeed) { $args += "--seed" }
    
    Write-Host "Executando: php artisan $($args -join ' ')" -ForegroundColor Cyan
    php artisan @args
    if ($LASTEXITCODE -ne 0) { throw "Falha ao executar as migrations." }
    Write-Host "Migrations executadas com sucesso." -ForegroundColor Green
}

function A_ResetDatabase {
    Check-Prerequisites
    Write-Host "`nATENÇÃO: Esta ação irá APAGAR TODOS OS DADOS do banco de dados." -ForegroundColor Red
    $confirmation = Read-Host "Tem certeza que deseja continuar e recriar o banco com as seeds? (S/N)"
    if ($confirmation.Trim().ToUpper() -ne "S") { Write-Host "Operação cancelada."; return }

    Write-Host "Executando: php artisan migrate:fresh --seed" -ForegroundColor Cyan
    php artisan migrate:fresh --seed
    if ($LASTEXITCODE -ne 0) { throw "Falha ao resetar o banco de dados." }
}

function A_CreateStorageLink {
    Check-Prerequisites
    Write-Host "`nCriando link simbólico de storage (storage:link)..." -ForegroundColor Cyan
    php artisan storage:link
    if ($LASTEXITCODE -ne 0) { throw "Falha ao criar o link de storage." }
}

function A_OptimizeClear {
    Check-Prerequisites
    Write-Host "`nLimpando todos os caches (optimize:clear)..." -ForegroundColor Cyan
    php artisan optimize:clear
    if ($LASTEXITCODE -ne 0) { throw "Falha ao limpar os caches." }
    Write-Host "Caches limpos com sucesso." -ForegroundColor Green
}

function Get-AvailablePort {
    param(
        [int]$StartPort = 8000,
        [int]$MaxPort = 65535
    )
    
    # Função auxiliar para verificar se uma porta está em uso
    function Test-PortInUse {
        param([int]$Port)
        try {
            $listener = New-Object System.Net.Sockets.TcpListener([System.Net.IPAddress]::Any, $Port)
            $listener.Start()
            $listener.Stop()
            return $false
        } catch {
            return $true
        }
    }

    $port = $StartPort
    while ($port -le $MaxPort) {
        if (-not (Test-PortInUse -Port $port)) {
            return $port
        }
        $port++
    }
    
    throw "Não foi possível encontrar uma porta disponível entre $StartPort e $MaxPort"
}

function A_ServeProject {
    Check-Prerequisites

    $bindHost = Read-Host "Host para o servidor (padrão: 127.0.0.1)"; if ([string]::IsNullOrWhiteSpace($bindHost)) { $bindHost = "127.0.0.1" }
    $desiredPort = Read-Host "Porta para o servidor (padrão: 8000)"; if ([string]::IsNullOrWhiteSpace($desiredPort)) { $desiredPort = "8000" }

    $port = Get-AvailablePort -StartPort ([int]$desiredPort)
    if ($port -ne $desiredPort) {
        Write-Host "A porta $desiredPort está ocupada. Usando a próxima porta livre: $port." -ForegroundColor Yellow
    }

    $url = "http://$($bindHost):$($port)"
    Write-Host "Iniciando servidor Laravel em $url ..." -ForegroundColor Cyan
    
    Start-Process -FilePath "php" -ArgumentList "artisan", "serve", "--host=$bindHost", "--port=$port"
    Start-Sleep -Seconds 1
    Write-Host "Abrindo $url no seu navegador padrão." -ForegroundColor Green
    Start-Process $url
}

function A_FrontendMenu {
    if (-not (Test-CommandExists "node")) { Write-Host "Node.js não encontrado. Pulando etapa de frontend." -ForegroundColor Yellow; return }
    if (-not (Test-CommandExists "npm"))  { Write-Host "NPM não encontrado. Pulando etapa de frontend." -ForegroundColor Yellow; return }

    Write-Host "`nOpções de Frontend:" -ForegroundColor Cyan
    Write-Host "1) Instalar dependências (npm install)"
    Write-Host "2) Iniciar modo de desenvolvimento (npm run dev)"
    Write-Host "3) Compilar para produção (npm run build)"
    Write-Host "0) Voltar ao menu principal"
    $option = Read-Host "Opção"
    switch ($option) {
        "1" { npm install; if ($LASTEXITCODE -ne 0) { throw "Falha no 'npm install'." } }
        "2" { Write-Host "Iniciando 'npm run dev'. Pressione Ctrl+C na nova janela para parar." -ForegroundColor Cyan; npm run dev }
        "3" { npm run build; if ($LASTEXITCODE -ne 0) { throw "Falha no 'npm run build'." } }
        "0" { return }
        default { Write-Host "Opção inválida." -ForegroundColor Red }
    }
}

function A_ApplyPendingEnv {
    $pendingPath = ".env.pending"
    if (-not (Test-Path $pendingPath)) {
        Write-Host "Nenhuma pendência encontrada ($pendingPath)." -ForegroundColor Yellow
        return
    }
    try {
        $content = Read-TextShared -Path $pendingPath
        Write-TextSafe -Path ".env" -Text $content
        Remove-Item $pendingPath -Force
        Write-Host "Pendências do arquivo .env foram aplicadas com sucesso." -ForegroundColor Green
    } catch {
        throw "Falha ao aplicar pendências do .env: $($_.Exception.Message)"
    }
}

function A_RunArtisanCommand {
    Check-Prerequisites
    $command = Read-Host "Digite o comando artisan (sem 'php artisan')"
    if ([string]::IsNullOrWhiteSpace($command)) {
        Write-Host "Nenhum comando fornecido." -ForegroundColor Yellow
        return
    }
    Write-Host "Executando: php artisan $command" -ForegroundColor Cyan
    Invoke-Expression "php artisan $command"
}


# --- (REVISADO) Função Principal de Instalação ---
function A_FullInstallation {
    Write-Host "`n--- Iniciando Instalação Completa do Projeto ---" -ForegroundColor Magenta
    
    # Verificação inicial de requisitos
    $requirements = Check-RequiredTools
    $hasErrors = $false
    foreach ($tool in $requirements.Keys) {
        if (-not $requirements[$tool].Exists) {
            Write-Host "❌ $tool não encontrado. Instalação não pode continuar." -ForegroundColor Red
            $hasErrors = $true
        } elseif (-not $requirements[$tool].OK) {
            Write-Host "⚠️ $tool versão $($requirements[$tool].Version) pode ser incompatível (requer $($requirements[$tool].Required))" -ForegroundColor Yellow
        }
    }
    if ($hasErrors) {
        throw "Requisitos essenciais não atendidos. Instale as ferramentas necessárias e tente novamente."
    }

    # Backup do .env se existir
    if (Test-Path ".env") {
        $backupPath = ".env.backup-$(Get-Date -Format 'yyyyMMdd-HHmmss')"
        Copy-Item ".env" $backupPath
        Write-Host "Backup do .env criado: $backupPath" -ForegroundColor Yellow
    }

    try {
        # Etapa 1: Dependências do Composer
        Write-Host "`n[1/6] Instalando dependências do Composer..." -ForegroundColor Cyan
        A_InstallDependencies

        # Etapa 2: NPM (se disponível)
        if ($requirements["Node.js"].Exists -and $requirements["NPM"].Exists) {
            Write-Host "`n[2/6] Instalando dependências NPM..." -ForegroundColor Cyan
            npm install
            if ($LASTEXITCODE -ne 0) { throw "Falha ao instalar dependências NPM" }
        } else {
            Write-Host "`n[2/6] Pulando instalação NPM (Node.js/NPM não encontrado)" -ForegroundColor Yellow
        }

        # Etapa 3: Criação do .env e Geração da Chave
        Write-Host "`n[3/6] Configurando arquivo de ambiente (.env) e chave da aplicação..." -ForegroundColor Cyan
        Ensure-EnvFileExists
        A_GenerateAppKey

        # Etapa 4: Configuração do Banco de Dados (Interativo)
        Write-Host "`n[4/6] Configurando o acesso ao banco de dados..." -ForegroundColor Cyan
        A_ConfigureDbEnv

        # Etapa 5: Migrations (com seeders)
        Write-Host "`n[5/6] Executando as migrations do banco de dados..." -ForegroundColor Cyan
        php artisan migrate --seed

        # Etapa 6: Finalização
        Write-Host "`n[6/6] Executando tarefas finais..." -ForegroundColor Cyan
        A_CreateStorageLink
        A_OptimizeClear

        if ($requirements["Node.js"].Exists -and $requirements["NPM"].Exists) {
            Write-Host "`nCompilando assets..." -ForegroundColor Cyan
            npm run build
            if ($LASTEXITCODE -ne 0) { 
                Write-Host "⚠️ Aviso: Falha ao compilar assets. Você pode tentar manualmente depois com 'npm run build'" -ForegroundColor Yellow
            }
        }
    } catch {
        Write-Host "`n❌ Erro durante a instalação: $($_.Exception.Message)" -ForegroundColor Red
        if (Test-Path ".env.backup-*") {
            $latestBackup = Get-ChildItem ".env.backup-*" | Sort-Object LastWriteTime -Descending | Select-Object -First 1
            if ($latestBackup) {
                Write-Host "Restaurando backup do .env: $($latestBackup.Name)" -ForegroundColor Yellow
                Copy-Item $latestBackup.FullName ".env" -Force
            }
        }
        throw
    }

    # Mensagem de sucesso
    Write-Host "`n==========================================================================" -ForegroundColor Green
    Write-Host "  ✅ PROJETO INSTALADO E CONFIGURADO COM SUCESSO!" -ForegroundColor Green
    Write-Host "  👉 Tudo pronto! Use a OPÇÃO 8 para iniciar o servidor." -ForegroundColor Green
    Write-Host "==========================================================================" -ForegroundColor Green
}

    # Mensagem de Conclusão
    Write-Host "`n==========================================================================" -ForegroundColor Green
    Write-Host "  ✅ PROJETO INSTALADO E CONFIGURADO COM SUCESSO!" -ForegroundColor Green
    Write-Host "  👉 Tudo pronto! Use a OPÇÃO 8 para iniciar o servidor." -ForegroundColor Green
    Write-Host "==========================================================================" -ForegroundColor Green
}


# ---------- Verificação de Requisitos ----------
function Parse-Version {
    param([string]$versionString)
    if ([string]::IsNullOrWhiteSpace($versionString)) { return "0.0.0" }
    
    # Extrai números da versão (aceita formatos diferentes)
    $match = [regex]::Match($versionString, '(\d+\.\d+\.\d+)')
    if ($match.Success) {
        return $match.Groups[1].Value
    }
    
    # Tenta formato X.Y
    $match = [regex]::Match($versionString, '(\d+\.\d+)')
    if ($match.Success) {
        return "$($match.Groups[1].Value).0"
    }
    
    return "0.0.0"
}

function Compare-Versions {
    param(
        [string]$current,
        [string]$required
    )
    try {
        $currentVersion = [version](Parse-Version $current)
        $requiredVersion = [version](Parse-Version $required)
        return $currentVersion -ge $requiredVersion
    } catch {
        return $false
    }
}

function Check-RequiredTools {
    $tools = @{
        "PHP" = {
            $phpVersion = try { (php --version)[0] } catch { "" }
            @{
                Exists = Test-CommandExists "php"
                Path = Get-CommandPath "php"
                Version = Parse-Version $phpVersion
                Required = "8.1.0"
                OK = Compare-Versions $phpVersion "8.1.0"
            }
        }
        "Composer" = {
            $composerVersion = try { composer --version } catch { "" }
            @{
                Exists = Test-CommandExists "composer"
                Path = Get-CommandPath "composer"
                Version = Parse-Version $composerVersion
                Required = "2.0.0"
                OK = Compare-Versions $composerVersion "2.0.0"
            }
        }
        "Node.js" = {
            $nodeVersion = try { node --version } catch { "" }
            @{
                Exists = Test-CommandExists "node"
                Path = Get-CommandPath "node"
                Version = Parse-Version $nodeVersion
                Required = "16.0.0"
                OK = Compare-Versions $nodeVersion "16.0.0"
            }
        }
        "NPM" = {
            $npmVersion = try { npm --version } catch { "" }
            @{
                Exists = Test-CommandExists "npm"
                Path = Get-CommandPath "npm"
                Version = Parse-Version $npmVersion
                Required = "8.0.0"
                OK = Compare-Versions $npmVersion "8.0.0"
            }
        }
        "Git" = {
            $gitVersion = try { git --version } catch { "" }
            @{
                Exists = Test-CommandExists "git"
                Path = Get-CommandPath "git"
                Version = Parse-Version $gitVersion
                Required = "2.0.0"
                OK = Compare-Versions $gitVersion "2.0.0"
            }
        }
    }

    $results = @{}
    foreach ($tool in $tools.Keys) {
        try {
            $results[$tool] = & $tools[$tool]
        } catch {
            $results[$tool] = @{
                Exists = $false
                Path = $null
                Version = "0.0.0"
                Required = $tools[$tool].Required
                OK = $false
            }
        }
    }

    return $results
}

function Show-RequirementsStatus {
    $results = Check-RequiredTools
    $anyWarning = $false
    $anyError = $false

    Write-Host "`nVerificação de Requisitos:" -ForegroundColor Cyan
    Write-Host "------------------------"
    
    foreach ($tool in $results.Keys) {
        $status = $results[$tool]
        $statusColor = "Red"
        $statusText = "❌ Não encontrado"
        
        if ($status.Exists) {
            if ($status.OK) {
                $statusColor = "Green"
                $statusText = "✅ $($status.Version)"
            } else {
                $statusColor = "Yellow"
                $statusText = "⚠️ $($status.Version) (Requer $($status.Required))"
                $anyWarning = $true
            }
        } else {
            $anyError = $true
        }

        Write-Host "$tool".PadRight(10) -NoNewline
        Write-Host $statusText -ForegroundColor $statusColor
        
        if ($status.Path) {
            Write-Host "         → $($status.Path)" -ForegroundColor DarkGray
        }
    }

    if ($anyError) {
        Write-Host "`n⛔ Ferramentas essenciais faltando. Instale-as antes de continuar." -ForegroundColor Red
    } elseif ($anyWarning) {
        Write-Host "`n⚠️ Algumas ferramentas podem precisar de atualização." -ForegroundColor Yellow
    } else {
        Write-Host "`n✅ Todos os requisitos atendidos!" -ForegroundColor Green
    }
}

# ---------- Interface do Usuário (UI) ----------
Clear-Host
Write-Host @"
=========================================
      UTILITÁRIO PROJETO LARAVEL     
      Versão: 1.0.0 (2025-11-07)
=========================================
"@ -ForegroundColor Cyan

# Verifica requisitos no início
Show-RequirementsStatus

while ($true) {
    try {
        Write-Host "`n============== MENU PRINCIPAL ===============" -ForegroundColor Cyan
        Write-Host "--- Instalação e Configuração ---"
        Write-Host " 1) Instalar dependências (composer install)"
        Write-Host " 2) Atualizar dependências (composer update)"
        Write-Host " 3) Configurar .env (Banco de Dados)"
        Write-Host " 4) Gerar chave da aplicação (key:generate)"
        Write-Host " 5) Rodar migrations (+ seed opcional)"
        Write-Host " 6) Resetar Banco de Dados (migrate:fresh --seed)" -ForegroundColor Yellow
        Write-Host "--- Comandos do Dia a Dia ---"
        Write-Host " 7) Criar link de storage (storage:link)"
        Write-Host " 8) Limpar caches (optimize:clear)"
        Write-Host " 9) Iniciar servidor (php artisan serve)"
        Write-Host " 10) Menu de Frontend (NPM)"
        Write-Host " 11) Executar Comando Artisan Avulso"
        Write-Host "--- Ferramentas ---"
        Write-Host " V) Verificar Requisitos" -ForegroundColor Gray
        Write-Host "---------------------------------------------"
        Write-Host " A) EXECUTAR INSTALAÇÃO COMPLETA (Recomendado para início)" -ForegroundColor White
        Write-Host " B) Aplicar pendências do .env (se houver)" -ForegroundColor White
        Write-Host " 0) Sair"
        Write-Host "=============================================" -ForegroundColor Cyan

        $option = Read-Host "Escolha uma opção"
        Clear-Host
        switch ($option.ToUpper()) {
            "1"  { A_InstallDependencies }
            "2"  { A_UpdateDependencies }
            "3"  { A_ConfigureDbEnv }
            "4"  { A_GenerateAppKey }
            "5"  { A_RunMigrations }
            "6"  { A_ResetDatabase }
            "7"  { A_CreateStorageLink }
            "8"  { A_OptimizeClear }
            "9"  { A_ServeProject }
            "10" { A_FrontendMenu }
            "11" { A_RunArtisanCommand }
            "A"  { A_FullInstallation }
            "B"  { A_ApplyPendingEnv }
            "V"  { Show-RequirementsStatus }
            "0"  { 
                Write-Host "`n👋 Obrigado por usar o Utilitário Laravel!" -ForegroundColor Cyan
                Write-Host "   Para sugestões/problemas: github.com/Joao-ALD/FonteNova/issues" -ForegroundColor Gray
                exit 
            }
            default { Write-Host "Opção inválida." -ForegroundColor Red }
        }
    }
    catch {
        Write-Host "`nERRO: $($_.Exception.Message)" -ForegroundColor Red
        Write-Host "A operação foi interrompida." -ForegroundColor Red
    }
}
