<#
install-laravel-universal.ps1
A universal, reusable installer for Laravel projects on Windows PowerShell.
Usage (examples):
  # Show help
  .\install-laravel-universal.ps1 -Help

  # Interactive full install (default)
  .\install-laravel-universal.ps1

  # Non-interactive, prefer sqlite, skip npm
  .\install-laravel-universal.ps1 -Force -DBProvider sqlite -SkipNpm

Notes:
- If .env is locked by another process the script will save changes to .env.pending and notify you.
- This script is safe to run from any Laravel project root (where artisan and composer.json exist).
#>

# Script Version
$SCRIPT_VERSION = "1.1.0"
$SCRIPT_DATE = "2025-11-07"

[CmdletBinding()]
param(
    [switch]$Help,
    [switch]$Force,
    [ValidateSet('sqlite','mysql','pgsql')][string]$DBProvider = 'mysql',
    [switch]$SkipNpm,
    [switch]$SkipComposerInstall,
    [switch]$RunMigrations,
    [switch]$RunSeed,
    [switch]$NonInteractive,
    [string]$LogFile = ".\logs\install-laravel.log",
    [switch]$UseDocker,
    [string]$DockerComposeFile = "docker-compose.yml"
)

# Initialize Logging
function Write-Log {
    param($Message, $Level = "INFO")
    try {
        # Ensure log directory exists
        $logDir = Split-Path -Parent $LogFile
        if (-not [string]::IsNullOrEmpty($logDir) -and -not (Test-Path $logDir)) {
            New-Item -Path $logDir -ItemType Directory -Force | Out-Null
        }
        
        $timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
        $logMessage = "[$timestamp] $Level - $Message"
        Add-Content -Path $LogFile -Value $logMessage -ErrorAction Stop
        return $logMessage
    }
    catch {
        Write-Host "Erro ao escrever no log ($LogFile): $($_.Exception.Message)" -ForegroundColor Red
        return $Message
    }
}

# Enhanced logging/output functions
function Write-Info { param($m) $msg = Write-Log $m "INFO"; Write-Host $m -ForegroundColor Cyan }
function Write-Success { param($m) $msg = Write-Log $m "SUCCESS"; Write-Host $m -ForegroundColor Green }
function Write-Warn { param($m) $msg = Write-Log $m "WARN"; Write-Host $m -ForegroundColor Yellow }
function Write-Err { param($m) $msg = Write-Log $m "ERROR"; Write-Host $m -ForegroundColor Red }
function Write-Debug { param($m) if ($VerbosePreference -eq 'Continue') { $msg = Write-Log $m "DEBUG"; Write-Host $m -ForegroundColor Gray } }

# Docker support
function Test-Docker {
    try {
        $dockerVersion = docker --version
        Write-Debug "Docker encontrado: $dockerVersion"
        return $true
    } catch {
        Write-Debug "Docker não encontrado ou não acessível"
        return $false
    }
}

function Get-DockerComposeStatus {
    if (-not (Test-Path "docker-compose.yml")) { return $null }
    try {
        $status = docker-compose ps --services --filter "status=running"
        Write-Debug "Serviços Docker rodando: $status"
        return $status
    } catch {
        Write-Debug "Erro ao verificar docker-compose: $($_.Exception.Message)"
        return $null
    }
}

if ($Help) {
    Write-Host @"
install-laravel-universal.ps1 - universal installer for Laravel projects

Parameters:
  -Help            Show this help and exit
  -Force           Run without asking for confirmations
  -DBProvider      sqlite (fast/dev) or mysql (default)
  -SkipNpm         Skip npm install / build steps
  -SkipComposerInstall Skip composer install step
  -RunMigrations   Run migrations (and seed if -RunSeed provided)
  -RunSeed         Seed database (use with -RunMigrations or will seed only)
  -NonInteractive  Avoid interactive prompts where possible

Examples:
  .\install-laravel-universal.ps1
  .\install-laravel-universal.ps1 -Force -DBProvider sqlite -SkipNpm -RunMigrations -RunSeed

This script will:
 - Check for required tools (php, composer, git, node/npm)
 - Optionally run composer install
 - Optionally run npm install and build
 - Create or copy .env from .env.example and (optionally) set DB to sqlite
 - Generate APP_KEY if missing
 - Optionally run migrations/seeds
 - Create storage link and clear caches

If .env cannot be written (locked), changes will be saved to .env.pending for manual application.
"@
    exit 0
}

# Helpers for resilient file IO (copied/adapted from project scripts)
function Read-TextShared {
    param([string]$Path)
    if (-not (Test-Path $Path)) { return $null }
    try {
        $fs = New-Object System.IO.FileStream($Path, [System.IO.FileMode]::Open, [System.IO.FileAccess]::Read, [System.IO.FileShare]::ReadWrite)
        $sr = New-Object System.IO.StreamReader($fs, [System.Text.Encoding]::UTF8, $true)
        $text = $sr.ReadToEnd()
        return $text
    } catch {
        return (Get-Content -Path $Path -Raw -ErrorAction SilentlyContinue)
    } finally {
        if ($sr) { $sr.Dispose() }
        if ($fs) { $fs.Dispose() }
    }
}

function Write-TextSafe {
    param([string]$Path, [string]$Text)
    $dir = Split-Path -Parent $Path
    if (-not ([string]::IsNullOrEmpty($dir)) -and -not (Test-Path $dir)) { New-Item -Path $dir -ItemType Directory | Out-Null }
    $tempPath = Join-Path $dir (".tmp-" + [guid]::NewGuid().ToString("N"))
    $encoding = New-Object System.Text.UTF8Encoding($false)
    [System.IO.File]::WriteAllText($tempPath, $Text, $encoding)
    try {
        [System.IO.File]::Replace($tempPath, $Path, "$Path.bak", $true)
    } catch {
        # If replace fails (locked), write pending file instead
        $pending = "$Path.pending"
        Copy-Item -Path $tempPath -Destination $pending -Force
        Remove-Item -Path $tempPath -Force -ErrorAction SilentlyContinue
        throw "LOCKED:$pending"
    }
}

function Assert-ProjectRoot {
    if (-not (Test-Path ".\artisan") -or -not (Test-Path ".\composer.json")) {
        throw "Este script deve ser executado na raiz de um projeto Laravel (onde há 'artisan' e 'composer.json')."
    }
}

function Test-CommandExists { param([string]$Name) return [bool](Get-Command $Name -ErrorAction SilentlyContinue) }
function Get-CommandPath { param([string]$Name) return (Get-Command $Name -ErrorAction SilentlyContinue).Path }

# Simple version parsing
function Parse-Version { param([string]$s) if ($null -eq $s) { return '0.0.0' } $m = [regex]::Match($s,'(\d+\.\d+\.\d+)'); if ($m.Success) { return $m.Groups[1].Value } $m = [regex]::Match($s,'(\d+\.\d+)'); if ($m.Success) { return "$($m.Groups[1].Value).0" } return '0.0.0' }
function Compare-Versions { param($cur,$req) try { return ([version](Parse-Version $cur)) -ge ([version](Parse-Version $req)) } catch { return $false } }

# Check prerequisites
function Check-Prereqs {
    $r = @{}
    $r.PHP = @{ Exists = Test-CommandExists 'php'; Path = Get-CommandPath 'php'; Version = (try{ (php --version) -split "`n" | Select-Object -First 1 } catch { '' }); Required='8.0.0'; OK = Compare-Versions $r.PHP.Version $r.PHP.Required }
    $r.Composer = @{ Exists = Test-CommandExists 'composer'; Path = Get-CommandPath 'composer'; Version = (try{ composer --version } catch { '' }); Required='2.0.0'; OK = Compare-Versions $r.Composer.Version $r.Composer.Required }
    $r.Node = @{ Exists = Test-CommandExists 'node'; Path = Get-CommandPath 'node'; Version = (try{ node --version } catch { '' }); Required='16.0.0'; OK = Compare-Versions $r.Node.Version $r.Node.Required }
    $r.Npm = @{ Exists = Test-CommandExists 'npm'; Path = Get-CommandPath 'npm'; Version = (try{ npm --version } catch { '' }); Required='7.0.0'; OK = Compare-Versions $r.Npm.Version $r.Npm.Required }
    $r.Git = @{ Exists = Test-CommandExists 'git'; Path = Get-CommandPath 'git'; Version = (try{ git --version } catch { '' }); Required='2.0.0'; OK = Compare-Versions $r.Git.Version $r.Git.Required }
    return $r
}

# Set or update key=value pairs in .env via resilient write
function Set-EnvValuesResilient {
    param([hashtable]$Pairs, [string]$Path = '.env')
    $content = Read-TextShared -Path $Path
    if ($null -eq $content) { $content = '' }
    $lines = $content -split '\r?\n'
    $new = [System.Collections.Generic.List[string]]::new()
    $keysToUpdate = [System.Collections.Generic.List[string]]::new()
    $Pairs.Keys | ForEach-Object { $keysToUpdate.Add($_) }
    foreach ($line in $lines) {
        $updated = $false
        foreach ($k in $keysToUpdate) {
            if ($line -match "^(?i)\s*$([regex]::Escape($k))\s*=") {
                $new.Add("$k=$($Pairs[$k])")
                [void]$keysToUpdate.Remove($k)
                $updated = $true
                break
            }
        }
        if (-not $updated) { $new.Add($line) }
    }
    if ($keysToUpdate.Count -gt 0) {
        if ($new.Count -gt 0 -and $new[-1].Trim() -ne '') { $new.Add('') }
        foreach ($k in $keysToUpdate) { $new.Add("$k=$($Pairs[$k])") }
    }
    $final = ($new -join "`r`n").TrimEnd() + "`r`n"
    try {
        Write-TextSafe -Path $Path -Text $final
        return @{ Success = $true }
    } catch {
        if ($_.Exception.Message -match '^LOCKED:(.*)$') {
            $pending = $Matches[1]
            return @{ Success = $false; Pending = $pending }
        }
        return @{ Success = $false; Error = $_.Exception.Message }
    }
}

# High-level flow
try {
    Assert-ProjectRoot
    $pr = Check-Prereqs
    Write-Info "Verificando pré-requisitos..."
    foreach ($k in $pr.Keys) {
        $v = $pr[$k]
        if ($v.Exists) {
            Write-Host ($k + "`t" + ($v.Version -replace "\r|\n",'')) -ForegroundColor Green
        } else {
            Write-Host ($k + "`t absent") -ForegroundColor Yellow
        }
    }

    if (-not $Force -and -not $NonInteractive) {
        $cont = Read-Host "Continuar com a instalação neste diretório? (S/N)" 
        if ($cont.Trim().ToUpper() -ne 'S') { Write-Warn 'Operação cancelada.'; exit 1 }
    }

    # Composer
    if (-not $SkipComposerInstall) {
        if (-not $pr.Composer.Exists) { Write-Warn 'Composer não encontrado; pule esta etapa com -SkipComposerInstall ou instale o Composer.' } else {
            Write-Info 'Instalando dependências PHP (composer install) ...'
            $env:COMPOSER_MEMORY_LIMIT='-1'
            composer install --no-interaction --prefer-dist --optimize-autoloader
            if ($LASTEXITCODE -ne 0) { throw 'composer install falhou' }
        }
    } else { Write-Info 'Pulando composer install (opção).' }

    # NPM
    if (-not $SkipNpm -and $pr.Npm.Exists -and $pr.Node.Exists) {
        Write-Info 'Instalando dependências Node (npm install) ...'
        npm install
        if ($LASTEXITCODE -ne 0) { Write-Warn 'npm install retornou erro; você pode executar manualmente.' }
    } elseif ($SkipNpm) { Write-Info 'Pulando npm (opção).'} else { Write-Warn 'Node/NPM não detectado; pulando NPM steps.' }

    # Ensure .env exists (copy from .env.example if present)
    if (-not (Test-Path '.env')) {
        if (Test-Path '.env.example') {
            try { Copy-Item '.env.example' '.env' -Force -ErrorAction Stop; Write-Info '.env criado a partir de .env.example' } catch { Write-Warn 'Não foi possível copiar .env.example (arquivo pode estar bloqueado).' }
        } else {
            Write-Info 'Nenhum .env.example encontrado; criando .env vazio.'
            try { Write-TextSafe -Path '.env' -Text ""; Write-Info '.env criado.' } catch { Write-Warn 'Não foi possível criar .env' }
        }
    } else { Write-Info '.env já existe.' }

    # Docker check if requested
    if ($UseDocker) {
        Write-Info "Verificando suporte a Docker..."
        if (Test-Docker) {
            $dockerServices = Get-DockerComposeStatus
            if ($dockerServices) {
                Write-Success "Serviços Docker detectados e rodando: $dockerServices"
            } else {
                Write-Warn "Docker disponível mas nenhum serviço rodando. Use 'docker-compose up -d' se necessário."
            }
        } else {
            Write-Warn "Docker solicitado mas não encontrado. Continuando com instalação local."
        }
    }

    # DB handling
    $dbConfig = @{
        'DB_CONNECTION' = $DBProvider
        'DB_HOST' = '127.0.0.1'
        'DB_PORT' = switch($DBProvider) {
            'mysql' { '3306' }
            'pgsql' { '5432' }
            default { '' }
        }
        'DB_DATABASE' = 'laravel'
        'DB_USERNAME' = if ($UseDocker) { 'root' } else { '' }
        'DB_PASSWORD' = if ($UseDocker) { 'password' } else { '' }
    }

    switch ($DBProvider) {
        'sqlite' {
            if (-not (Test-Path '.\database')) { New-Item '.\database' -ItemType Directory | Out-Null }
            $sqliteFile = Join-Path (Resolve-Path '.\database').Path 'database.sqlite'
            if (-not (Test-Path $sqliteFile)) { 
                New-Item $sqliteFile -ItemType File | Out-Null
                Write-Info "Arquivo SQLite criado: $sqliteFile" 
            }
            $dbConfig['DB_CONNECTION'] = 'sqlite'
            $dbConfig['DB_DATABASE'] = $sqliteFile
            $dbConfig['DB_HOST'] = ''
            $dbConfig['DB_PORT'] = ''
            $dbConfig['DB_USERNAME'] = ''
            $dbConfig['DB_PASSWORD'] = ''
        }
        'pgsql' {
            if ($UseDocker) {
                $dbConfig['DB_HOST'] = 'pgsql'
                Write-Info 'Configurando PostgreSQL para Docker'
            }
            Write-Info "Configurando PostgreSQL na porta $($dbConfig['DB_PORT'])"
        }
        'mysql' {
            if ($UseDocker) {
                $dbConfig['DB_HOST'] = 'mysql'
                Write-Info 'Configurando MySQL para Docker'
            }
            Write-Info "Configurando MySQL na porta $($dbConfig['DB_PORT'])"
        }
        default {
            Write-Warn "Provedor de banco de dados $DBProvider não suportado completamente."
        }
    }

    $res = Set-EnvValuesResilient -Pairs $dbConfig
    if (-not $res.Success) { 
        if ($res.Pending) { 
            Write-Warn ".env está bloqueado. Alterações salvas em: $($res.Pending)" 
        } else { 
            Write-Warn "Falha ao atualizar .env: $($res.Error)" 
        }
    } else {
        Write-Success "Configuração do banco de dados atualizada para $DBProvider"
    }

    # APP KEY
    $envContent = Read-TextShared -Path '.env'
    if ($null -eq $envContent -or -not ($envContent -match '^APP_KEY=')) {
        Write-Info 'Gerando APP_KEY...'
        php artisan key:generate
        if ($LASTEXITCODE -ne 0) { Write-Warn 'Falha ao gerar APP_KEY automaticamente. Gere manualmente com php artisan key:generate.' }
    } else { Write-Info 'APP_KEY já presente.' }

    # Migrations/Seeding
    if ($RunMigrations) {
        $migrateArgs = 'migrate'
        if ($RunSeed) { $migrateArgs += ' --seed' }
        Write-Info "Executando: php artisan $migrateArgs"
        Invoke-Expression "php artisan $migrateArgs"
        if ($LASTEXITCODE -ne 0) { 
            Write-Warn 'Migrations falharam (verifique o DB).'
            return
        }
        Write-Success 'Migrations executadas.'
    } elseif ($RunSeed) {
        Write-Info 'Executando seeders (php artisan db:seed)'
        php artisan db:seed
        if ($LASTEXITCODE -ne 0) { 
            Write-Warn 'Seeding falhou (verifique o DB).'
            return
        }
        Write-Success 'Seeding executado.'
    }

    # Storage link and optimize
    Write-Info 'Criando link de storage e limpando caches...'
    php artisan storage:link | Out-Null
    php artisan optimize:clear | Out-Null

    # Build assets if not skipped
    if (-not $SkipNpm -and $pr.Npm.Exists -and $pr.Node.Exists) {
        if ($NonInteractive -or $Force) {
            Write-Info 'Compilando assets (npm run build) ...'
            npm run build
            if ($LASTEXITCODE -ne 0) { Write-Warn 'npm run build falhou; tente manualmente.' }
        } else {
            $doBuild = Read-Host 'Deseja compilar assets para produção agora? (S/N)'
            if ($doBuild.Trim().ToUpper() -eq 'S') { npm run build }
        }
    }

    Write-Success "\nInstalação concluída. Inicie o servidor com: php artisan serve"
    exit 0
} catch {
    Write-Err "Erro crítico: $($_.Exception.Message)"
    exit 2
}
