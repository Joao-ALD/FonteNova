# Guia Rápido Laravel com Composer, Artisan e GitHub

> ⚠️ **Lembrete para a equipe:** Sempre mantenha este guia atualizado conforme novas versões do Laravel forem lançadas ou alterações forem feitas nos nossos fluxos.

---

## 📦 Criando um Projeto Laravel

Use o Composer para criar um novo projeto Laravel com a última versão disponível:

```bash
composer create-project laravel/laravel nome-do-projeto
cd nome-do-projeto
```

> 💡 **Dica:** Padronize o nome dos projetos com `kebab-case`, ex: `chatbot-agua-inteligente`

---

## 🚀 Executando o Projeto

Para rodar o servidor embutido do Laravel:

```bash
php artisan serve
```

> **Nota:** Os assets (CSS, JS, imagens) devem estar na pasta `public/assets` para funcionar corretamente com `php artisan serve`.

### Alternativa com Vite (para front-end)

```bash
npm run dev
```

> 💡 Esse comando compila os assets do `resources/` com base no `vite.config.js`.

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

> ⚠️ **Lembrete:** Sempre revisar os nomes e namespace criados — mantenha consistência.

---

### ✏️ Editando a Migration

No arquivo gerado em `database/migrations/`, edite a função `up()`:

```php
$table->string('nome_da_coluna');
$table->integer('idade');
$table->boolean('ativo');
```

> 💡 Use nomes de colunas em inglês se o projeto for internacional.

---

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

## 🌱 Executando Seeders

Rodar apenas os seeders:

```bash
php artisan db:seed
```

Resetar o banco e rodar migrations + seeders:

```bash
php artisan migrate:fresh --seed
```

> ⚠️ **Atenção:** `migrate:fresh` APAGA todas as tabelas. Só use em ambiente de desenvolvimento!

---

## 📤 Métodos HTTP Importantes no Laravel

* `PUT`: Usado para **atualizações**
* `DELETE`: Usado para **exclusões**

> 💡 No Blade, use `@method('PUT')` ou `@method('DELETE')` dentro dos formulários.

---

## 💻 Estrutura de Pastas Recomendada

```
C:/
└── Documents/
    └── projects_laravel/
        └── nome-do-projeto/
```

> ⚠️ **Padrão de equipe:** Todos os projetos Laravel devem ficar em `projects_laravel/`

---

## 🧩 GitHub e .gitignore

### Por que a pasta `vendor/` não vai para o GitHub?

O `.gitignore` do Laravel ignora `vendor/` porque:

* É muito pesada
* É recriada com `composer install`
* Não é código nosso

---

### Após clonar o projeto:

1. Instale as dependências:

```bash
composer install
```

2. Copie o `.env`:

```bash
cp .env.example .env
```

3. Gere a chave da aplicação:

```bash
php artisan key:generate
```

4. Configure o `.env` com os dados do banco:

```env
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. Execute as migrations:

```bash
php artisan migrate
```

6. Rode os seeders (opcional):

```bash
php artisan db:seed
```

7. (Opcional) Rodar tudo de uma vez:

```bash
php artisan migrate:fresh --seed
```

8. Inicie o servidor:

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

> 💡 Use o GitHub Desktop se estiver aprendendo Git ainda.

---

## ✅ Resumo para onboardings

* `composer create-project` → cria projeto
* `php artisan make:model -mc` → cria estrutura
* `php artisan migrate` → cria tabelas
* `php artisan db:seed` → insere dados de exemplo
* `php artisan migrate:fresh --seed` → recria tudo do zero
* Nunca suba `vendor/` no GitHub
* Após clonar: `composer install` + `.env` + `key:generate` + `migrate`

---

> 📌 **Nota para a equipe:** Use `Ctrl + Shift + V` no VSCode para pré-visualizar este `.md`.