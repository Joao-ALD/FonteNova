# 📌 Guia Rápido Laravel — Lembretes do Dia a Dia

> ⚠️ **Lembrete para a equipe:** mantenha este guia atualizado sempre que novas versões do Laravel forem lançadas ou quando mudarmos a forma de trabalhar no projeto.

---

## 📦 Criando um Projeto Laravel

```bash
composer create-project laravel/laravel nome-do-projeto
cd nome-do-projeto
```

💡 Padronize os nomes com `kebab-case`, ex: `chatbot-agua-inteligente`.

---

## 🚀 Executando o Projeto

Rodar o servidor embutido:

```bash
php artisan serve
```

💡 **Atenção:** coloque os **assets (CSS, JS, imagens)** em `public/assets` para funcionarem corretamente.

Compilar assets com **Vite**:

```bash
npm install
npm run dev
```

💡 O comando compila os arquivos de `resources/` com base no `vite.config.js`.

---

## 🛠️ Criando Estruturas Rápidas

Criação de Model, Migration, Controller, Factory e Seeder:

```bash
php artisan make:model NomeDoModel -mcrfs
```

* `-m` → cria migration
* `-c` → cria controller
* `-r` → controller resource
* `-f` → cria factory
* `-s` → cria seeder

Separado:

```bash
php artisan make:controller NomeController
```

⚠️ Sempre mantenha consistência nos nomes e namespaces.

---

## ✏️ Migrações (Banco de Dados)

Editar o método `up()` em `database/migrations/`:

```php
$table->string('nome');
$table->integer('idade');
$table->boolean('ativo');
```

Executar migrations:

```bash
php artisan migrate
```

Reverter última:

```bash
php artisan migrate:rollback
```

Recriar tudo:

```bash
php artisan migrate:fresh --seed
```

⚠️ `migrate:fresh` apaga todas as tabelas — só use em **desenvolvimento**.

---

## 💾 Models e Relacionamentos

Em `app/Models/NomeDoModel.php`:

```php
class NomeDoModel extends Model
{
    protected $fillable = ['nome', 'idade', 'ativo'];

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
```

---

## 🌱 Seeders & Factories

Criar seeder:

```bash
php artisan make:seeder UsuarioSeeder
php artisan db:seed --class=UsuarioSeeder
```

💡 Use `faker` nas factories para dados realistas.

---

## 🌐 Rotas (Routing)

```php
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::resource('posts', PostController::class);
```

💡 `Route::resource` gera um CRUD completo.

---

## ✅ Validação de Dados

```php
$request->validate([
  'titulo' => 'required|unique:posts|max:255',
  'conteudo' => 'required',
]);
```

---

## 📄 Blade (Views)

```blade
@extends('layouts.app')

@section('content')
  <h1>{{ $post->titulo }}</h1>
  @foreach ($posts as $post)
    <div>{{ $post->conteudo }}</div>
  @endforeach
@endsection
```

---

## ⭐ Comandos Artisan Úteis

```bash
php artisan route:list      # listar rotas
php artisan tinker          # terminal interativo
php artisan config:clear    # limpar cache de configs
php artisan cache:clear     # limpar cache geral
php artisan migrate:status  # ver status das migrations
```

---

## 📤 Métodos HTTP Importantes

* **GET** → buscar dados
* **POST** → criar
* **PUT/PATCH** → atualizar (`@method('PUT')`)
* **DELETE** → excluir (`@method('DELETE')`)

---

## 💻 Estrutura de Pastas Recomendada

```
C:/Documents/projects_laravel/nome-do-projeto/
├── app/Http/Controllers
├── app/Models
├── database/migrations
├── resources/views
├── routes/web.php
└── public/
```

⚠️ Padrão da equipe: todos os projetos ficam em `projects_laravel/`.

---

## 🧩 GitHub e .gitignore

A pasta `vendor/` **não vai para o GitHub** porque:

* é pesada,
* é recriada com `composer install`,
* não é código nosso.

---

### Após clonar um projeto:

1. Instalar dependências:

```bash
composer install
npm install
```

2. Copiar `.env`:

```bash
cp .env.example .env
```

3. Gerar chave:

```bash
php artisan key:generate
```

4. Configurar banco no `.env`:

```env
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. Rodar migrations:

```bash
php artisan migrate
```

6. Rodar seeders (opcional):

```bash
php artisan db:seed
```

7. Recriar tudo de uma vez:

```bash
php artisan migrate:fresh --seed
```

8. Iniciar servidor:

```bash
php artisan serve
```

---

## 🔁 Fluxo com Git

### No PC de origem:

```bash
git add .
git commit -m "mensagem do commit"
git push
```

### No PC de destino:

```bash
git clone <url-do-repositorio>
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

💡 Use o **GitHub Desktop** se estiver aprendendo Git.

---

## 🔧 Extensões Úteis VS Code

* Laravel Extension Pack
* Laravel Blade Snippets
* PHP Intelephense
* DotENV
* Laravel Artisan

---

## ✅ Resumo Express

* `composer create-project` → cria projeto
* `php artisan serve` → inicia servidor
* `php artisan make:model Nome -mcrfs` → cria estrutura completa
* `php artisan migrate:fresh --seed` → recria banco com dados de teste
* `php artisan route:list` → lista rotas
* Nunca suba `vendor/` ou `.env`
* Após clonar: `composer install` + `.env` + `key:generate` + `migrate`

---

📌 **Nota final para a equipe:** use `Ctrl + Shift + V` no VSCode para visualizar este `.md`.