Clear-Host
Write-Host "====================================="
Write-Host "      INSTALADOR PROJETO LARAVEL     "
Write-Host "====================================="

function Verificar-Comando {
    param($comando)
    if (-not (Get-Command $comando -ErrorAction SilentlyContinue)) {
        Write-Host "`nErro: O comando '$comando' não está disponível no PATH." -ForegroundColor Yellow
        return $false
    }
    return $true
}

# Verificar Composer e PHP
$temComposer = Verificar-Comando "composer"
$temPHP = Verificar-Comando "php"

# Detectar caminho do MySQL (XAMPP)
$possiveisCaminhos = @(
    "C:\xampp\mysql\bin\mysql.exe",
    "$env:ProgramFiles\xampp\mysql\bin\mysql.exe",
    "$env:USERPROFILE\xampp\mysql\bin\mysql.exe"
)

$mysqlPath = $null
foreach ($caminho in $possiveisCaminhos) {
    if (Test-Path $caminho) {
        $mysqlPath = $caminho
        break
    }
}

if (-not $mysqlPath) {
    Write-Host "`nErro: mysql.exe não encontrado em nenhum dos caminhos padrão do XAMPP." -ForegroundColor Red
    Write-Host "Por favor, ajuste o script com o caminho correto do seu XAMPP (mysql.exe)." -ForegroundColor Red
    exit 1
} else {
    Write-Host "`nMySQL detectado em: $mysqlPath" -ForegroundColor Green
}

# Menu
Write-Host "`nEscolha uma opção:"
Write-Host "1. Atualizar dependências"
Write-Host "2. Instalar dependências"
Write-Host "3. Copiar .env e configurar banco"
Write-Host "4. Gerar chave da aplicação"
Write-Host "5. Rodar migrations"
Write-Host "6. Iniciar servidor Laravel"
Write-Host "7. Executar tudo (instalação completa)"
Write-Host "0. Sair"

$opcao = Read-Host "Digite sua opção (0-7)"

function Atualizar-Dependencias {
    if (-not $temComposer) { throw "Composer não está disponível." }
    Write-Host "`nAtualizando dependências..."
    composer update
    if ($LASTEXITCODE -ne 0) { throw "Erro ao atualizar dependências." }
}

function Instalar-Dependencias {
    if (-not $temComposer) { throw "Composer não está disponível." }
    Write-Host "`nInstalando dependências..."
    composer install
    if ($LASTEXITCODE -ne 0) { throw "Erro ao instalar dependências." }
}

function Configurar-Env {
    if (-not (Test-Path ".env")) {
        Copy-Item ".env.example" ".env"
        Write-Host "Arquivo .env copiado com sucesso."
    }

    $db_name = Read-Host "Digite o nome do banco de dados"
    $db_user = Read-Host "Digite o usuário do MySQL"
    $db_pass = Read-Host "Digite a senha do MySQL (pode estar vazia)"

    Write-Host "Criando banco de dados (caso não exista)..."
    $cmd = "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    & "$mysqlPath" -u $db_user -p"$db_pass" -e $cmd
    if ($LASTEXITCODE -ne 0) { throw "Erro ao criar banco de dados. Verifique usuário e senha." }

    # Atualizar .env
    (Get-Content ".env") -replace "DB_DATABASE=.*", "DB_DATABASE=$db_name" |
        Set-Content ".env"
    (Get-Content ".env") -replace "DB_USERNAME=.*", "DB_USERNAME=$db_user" |
        Set-Content ".env"
    (Get-Content ".env") -replace "DB_PASSWORD=.*", "DB_PASSWORD=$db_pass" |
        Set-Content ".env"

    Write-Host "Arquivo .env atualizado com as configurações do banco."
}

function Gerar-Chave {
    if (-not $temPHP) { throw "PHP não está disponível." }
    php artisan key:generate
    if ($LASTEXITCODE -ne 0) { throw "Erro ao gerar chave." }
}

function Rodar-Migrations {
    if (-not $temPHP) { throw "PHP não está disponível." }
    php artisan migrate
    if ($LASTEXITCODE -ne 0) { throw "Erro ao rodar migrations." }
}

function Rodar-Servidor {
    if (-not $temPHP) { throw "PHP não está disponível." }
    Start-Process "php" "artisan serve"
    Write-Host "Servidor Laravel iniciado em nova janela."
}

try {
    switch ($opcao) {
        "1" { Atualizar-Dependencias }
        "2" { Instalar-Dependencias }
        "3" { Configurar-Env }
        "4" { Gerar-Chave }
        "5" { Rodar-Migrations }
        "6" { Rodar-Servidor }
        "7" {
            Atualizar-Dependencias
            Instalar-Dependencias
            Configurar-Env
            Gerar-Chave
            Rodar-Migrations
            Rodar-Servidor
        }
        "0" { Write-Host "Saindo..."; exit }
        default { Write-Host "Opção inválida." }
    }
}
catch {
    Write-Host "`nErro: $_" -ForegroundColor Red
}

pause
