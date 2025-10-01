@echo off
echo ================================
echo INSTALANDO PROJETO LARAVEL
echo ================================

REM 1. Atualizar dependências
echo Atualizando dependências PHP...
composer update
if errorlevel 1 goto erro_composer

REM 2. Instalar dependências
echo Instalando dependências PHP...
composer install
if errorlevel 1 goto erro_composer

REM 3. Copiar .env.example para .env, caso não exista
if not exist .env (
    echo Copiando .env.example para .env...
    copy .env.example .env
)

REM 4. Configurar banco de dados - configurar estes valores conforme seu ambiente
set /p db_name="Digite o nome do banco de dados a ser criado: "
set /p db_user="Digite o usuário do MySQL: "
set /p db_pass="Digite a senha do MySQL: "

REM 5. Criar banco de dados MySQL
echo Criando banco de dados %db_name% (caso nao exista)...
mysql -u %db_user% -p%db_pass% -e "CREATE DATABASE IF NOT EXISTS %db_name% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
if errorlevel 1 goto erro_mysql

REM 6. Atualizar o arquivo .env com o nome do banco e usuário
powershell -Command "(Get-Content .env) -replace 'DB_DATABASE=.*', 'DB_DATABASE=%db_name%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_USERNAME=.*', 'DB_USERNAME=%db_user%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PASSWORD=.*', 'DB_PASSWORD=%db_pass%' | Set-Content .env"

REM 7. Gerar chave da aplicação
php artisan key:generate

REM 8. Rodar as migrations
php artisan migrate

REM 9. Rodar servidor
php artisan serve

pause
exit

:erro_composer
echo Erro ao instalar/atualizar dependências. Verifique se o Composer está instalado e configurado no PATH.
pause
exit

:erro_mysql
echo Erro ao conectar no MySQL. Verifique usuário e senha.
pause
exit