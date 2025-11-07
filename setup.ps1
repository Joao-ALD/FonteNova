# Script simplificado para configuração inicial
Write-Host "=== Configurando o Projeto Laravel ===" -ForegroundColor Cyan

try {
    # 1. Instalar dependências do Composer
    Write-Host "`n[1/5] Instalando dependências do Composer..." -ForegroundColor Cyan
    composer install --no-interaction

    # 2. Instalar dependências NPM
    Write-Host "`n[2/5] Instalando dependências NPM..." -ForegroundColor Cyan
    npm install

    # 3. Configurar ambiente
    Write-Host "`n[3/5] Configurando ambiente..." -ForegroundColor Cyan
    if (-not (Test-Path ".env")) {
        Copy-Item ".env.example" ".env"
    }
    php artisan key:generate

    # 4. Configurar banco de dados
    Write-Host "`n[4/5] Configurando banco de dados SQLite (desenvolvimento)..." -ForegroundColor Cyan
    if (-not (Test-Path ".\database")) { 
        New-Item ".\database" -ItemType Directory | Out-Null 
    }
    $sqlitePath = ".\database\database.sqlite"
    if (-not (Test-Path $sqlitePath)) { 
        New-Item $sqlitePath -ItemType File | Out-Null 
    }
    ((Get-Content -Path ".env" -Raw) -replace "DB_CONNECTION=.*","DB_CONNECTION=sqlite") | Set-Content -Path ".env"
    ((Get-Content -Path ".env" -Raw) -replace "DB_DATABASE=.*","DB_DATABASE=$sqlitePath") | Set-Content -Path ".env"

    # 5. Executar migrations
    Write-Host "`n[5/5] Executando migrations..." -ForegroundColor Cyan
    php artisan migrate --seed
    php artisan storage:link

    # Compilar assets
    Write-Host "`nCompilando assets..." -ForegroundColor Cyan
    npm run build

    Write-Host "`n✅ Instalação concluída com sucesso!" -ForegroundColor Green
    Write-Host "Para iniciar o servidor, execute: php artisan serve" -ForegroundColor Yellow

} catch {
    Write-Host "`n❌ Erro: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Verifique os erros acima e tente novamente." -ForegroundColor Yellow
}