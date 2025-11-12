# 📗 Comandos Laravel e Git - Guia Rápido

**1. Criar um novo projeto Laravel**  
Use o Composer para iniciar um novo projeto Laravel.

```bash
composer create-project laravel/laravel nome-do-projeto
```

**2. Iniciar o servidor de desenvolvimento**  
Executa o servidor local embutido do Laravel.

```bash
php artisan serve
```

**3. Instalar dependências do front-end**  
Instala os pacotes definidos no `package.json`.

```bash
npm install
```

**4. Compilar assets com Vite**  
Compila os arquivos front-end com hot reload.

```bash
npm run dev
```

**5. Criar Model, Migration e Controller**  
Gera estrutura completa para uma entidade.

```bash
php artisan make:model Nome -mc
```

**6. Executar as migrations**  
Cria as tabelas no banco de dados.

```bash
php artisan migrate
```

**7. Popular o banco com dados de teste**  
Executa os seeders definidos.

```bash
php artisan db:seed
```

**8. Apagar e recriar o banco com dados de teste**  
Limpa todas as tabelas e recria com seeders.

```bash
php artisan migrate:fresh --seed
```

**9. Instalar dependências do Laravel**  
Recria a pasta `vendor/` com todas as dependências.

```bash
composer install
```

**10. Gerar chave de segurança no .env**  
Cria a chave de criptografia da aplicação.

```bash
php artisan key:generate
```

**11. Clonar repositório do GitHub**  
Baixa o projeto remoto para sua máquina.

```bash
git clone https://URL_DO_SEU_REPOSITORIO.git
```

**12. Adicionar arquivos modificados ao commit**  
Prepara os arquivos para serem versionados.

```bash
git add .
```

**13. Criar commit com mensagem**  
Salva as alterações localmente com uma descrição.

```bash
git commit -m "mensagem"
```

**14. Enviar alterações para o GitHub**  
Publica suas alterações no repositório remoto.

```bash
git push
```

**15. Receber alterações do GitHub**  
Atualiza seu projeto com as últimas mudanças.

```bash
git pull
```

**16. Listar todas as rotas**  
Mostra todas as rotas registradas no projeto.

```bash
php artisan route:list
```

**17. Abrir terminal interativo do Laravel**  
Permite testar comandos e interagir com os Models.

```bash
php artisan tinker
```

**18. Limpar cache de configurações**  
Remove o cache das configurações da aplicação.

```bash
php artisan config:clear
```

**19. Limpar cache geral**  
Remove todos os caches da aplicação.

```bash
php artisan cache:clear
```

**20. Verificar status das migrations**  
Mostra quais migrations já foram executadas.

```bash
php artisan migrate:status
```

**21. Criar um seeder**  
Gera um arquivo para popular o banco.

```bash
php artisan make:seeder NomeSeeder
```

**22. Executar seeder específico**  
Roda apenas o seeder indicado.

```bash
php artisan db:seed --class=NomeSeeder
```

**23. Criar um controller**  
Gera um controller para sua aplicação.

```bash
php artisan make:controller NomeController
```

**24. Reverter última migration**  
Desfaz a última alteração no banco.

```bash
php artisan migrate:rollback
```

**25. Criar arquivo .env a partir do exemplo**  
Copia o arquivo de ambiente padrão.

```bash
cp .env.example .env
```
Veja também o [README](..\README.md).