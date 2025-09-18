# Guia Rápido Laravel com Composer, Artisan e GitHub

## 📦 Criando um Projeto Laravel

Use o Composer para criar um novo projeto Laravel com a última versão disponível:

```bash
composer create-project laravel/laravel nome-do-projeto
cd nome-do-projeto
```

## 🚀 Executando o Projeto

Para rodar o servidor embutido do Laravel:

```bash
php artisan serve
```

> **Nota**: Os assets (CSS, JS, imagens) devem estar na pasta `public/assets` para funcionar corretamente com `php artisan serve`.

### Alternativa com Vite (para front-end)

```bash
npm run dev
```

> Este comando compila os assets que estão na pasta `resources` e serve o front-end. Não conecta diretamente com o back-end.

---

## 🛠️ Criando Model, Migration e Controller

Crie tudo de uma vez (Model, Migration e Controller):

```bash
php artisan make:model NomeDoModel -mc
```

Ou crie separadamente:

```bash
php artisan make:controller NomeController
```

### ✏️ Editando a Migration

No arquivo gerado em `database/migrations/`, edite a função `up()`:

```php
$table->string('nome_da_coluna');
$table->integer('idade');
$table->boolean('ativo');
```

### 💾 Editando o Model

Abra o arquivo em `app/Models/NomeDoModel.php` e adicione o atributo `$fillable`:

```php
class NomeDoModel extends Model
{
    protected $fillable = ['nome_da_coluna', 'idade', 'ativo'];
}
```

---

## 🧪 Executando Migrações

Para aplicar as migrations e criar as tabelas no banco:

```bash
php artisan migrate
```

---

## 📤 Métodos HTTP Importantes no Laravel

- `PUT`: Usado para **atualizações** (update)
- `DELETE`: Usado para **exclusão** (delete)

> Certifique-se de utilizar os métodos corretos ao criar formulários no Blade.

---

## 💻 Estrutura de Pastas Recomendada

Exemplo de estrutura:

```
C:/
└── Documents/
    └── projects_laravel/
        └── composer create-project laravel/laravel nome-do-projeto
```

---

## 🧩 Integrando com GitHub e o Papel do `.gitignore`

### ❓ Por que a pasta `vendor/` não vai para o GitHub?

O arquivo `.gitignore` do Laravel ignora a pasta `vendor/` por motivos de:

1. **Tamanho** – muito grande
2. **Redundância** – não foi escrita por você
3. **Recriável** – pode ser gerada com `composer install`

### 📦 Solução ao clonar o projeto em outro PC

#### 1. Instale as dependências:

```bash
composer install
```

#### 2. Crie e configure o `.env`:

```bash
cp .env.example .env
```

#### 3. Gere a chave da aplicação:

```bash
php artisan key:generate
```

#### 4. Configure a conexão com o banco de dados no `.env`:

```env
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

#### 5. Execute as migrações (opcional):

```bash
php artisan migrate
```

#### 6. Inicie o servidor:

```bash
php artisan serve
```

---

## 🔁 Fluxo Correto de Trabalho com Git e Laravel

### No PC de origem:

```bash
git add .
git commit -m "mensagem do commit"
git push
```

### No PC de destino:

```bash
git clone <url-do-repositorio>  # ou git pull
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## ✅ Resumo

- Use `composer create-project` para iniciar projetos.
- Use comandos Artisan para gerar estrutura rapidamente.
- Nunca suba a pasta `vendor/` no GitHub.
- Sempre use `composer install` após clonar.
- Configure `.env` e gere a key com `php artisan key:generate`.

---