# Guia Completo Laravel e Git para Iniciantes

## Laravel - Guia Unificado

Com certeza\! Unifiquei os dois documentos, organizando as informações de forma lógica e didática. O resultado é um guia completo que vai desde a criação do projeto até o fluxo de trabalho em equipe com Git, mantendo os termos técnicos e as boas práticas.

Aqui está a versão unificada do guia:

-----

# Guia de Boas Práticas e Lembretes para Projetos Laravel

> ⚠️ **Lembrete para a equipe:** Mantenha este guia sempre atualizado. Ele é a nossa referência para garantir a consistência e a qualidade em todos os projetos.

## 📦 Parte 1: Início e Configuração do Projeto

Esta seção cobre o primeiro passo: criar e rodar um novo projeto Laravel.

### 1.1. Criando um Novo Projeto

Use o Composer para criar um projeto com a versão mais recente do Laravel.

```bash
# Navegue até a pasta onde os projetos devem ficar
cd C:/Documents/projects_laravel/

# Crie o projeto
composer create-project laravel/laravel nome-do-projeto

# Acesse a pasta do projeto recém-criado
cd nome-do-projeto
```

> 💡 **Dica de Padrão:** Padronize os nomes dos projetos com `kebab-case` (tudo minúsculo e separado por hífen). Ex: `sistema-gestao-clientes`.

### 1.2. Executando o Projeto

Você tem duas maneiras principais de rodar o ambiente de desenvolvimento:

**A) Servidor Embutido do Artisan (Back-end e Front-end Simples)**

Este comando sobe um servidor de desenvolvimento completo.

```bash
php artisan serve
```

> **Nota:** Com `artisan serve`, os assets (CSS, JS, imagens) devem estar na pasta `public` para serem carregados corretamente pelo navegador.

**B) Vite (Front-end Moderno)**

Este comando compila os assets (Vue, React, SASS, etc.) que estão na pasta `resources` e os serve com *Hot Module Replacement* (HMR), que atualiza a página sem precisar de recarregamento. É ideal para quem está trabalhando no front-end.

```bash
npm install
npm run dev
```

> 💡 Use `npm run dev` em um terminal e `php artisan serve` em outro para ter o ambiente completo rodando.

-----

## 🛠️ Parte 2: Desenvolvimento (O Ciclo MVC)

Aqui está o fluxo básico para criar novas funcionalidades no padrão Model-View-Controller.

### 2.1. Criando Model, Migration e Controller

Use o comando `make:model` com as flags `-mc` para criar o Model, a Migration e o Controller de uma só vez.

```bash
# Substitua "NomeDoModel" pelo nome da sua entidade no singular (ex: Produto, Usuario)
php artisan make:model NomeDoModel -mc
```

> ⚠️ **Lembrete:** O Laravel segue convenções de nomenclatura. Models são no singular (`User`), enquanto controllers e migrations podem variar (`UserController`, `create_users_table`). Mantenha a consistência\!

### 2.2. Editando a Migration (A Estrutura do Banco)

O arquivo da migration define as colunas da sua tabela no banco de dados.

1.  **Localização:** `database/migrations/`
2.  **O que fazer:** Edite a função `up()` para adicionar as colunas.

<!-- end list -->

```php
// Exemplo dentro do método up()
$table->id(); // Chave primária auto-incremento
$table->string('name'); // Coluna de texto (VARCHAR)
$table->text('description')->nullable(); // Coluna de texto longo, pode ser nula
$table->integer('quantity')->default(0); // Coluna de número inteiro com valor padrão 0
$table->boolean('is_active')->default(true); // Coluna booleana
$table->timestamps(); // Cria as colunas `created_at` e `updated_at`
```

> 💡 **Dica de Padrão:** Use nomes de colunas em inglês para facilitar a manutenção e a possível internacionalização do projeto.

### 2.3. Editando o Model (A Conexão com o Banco)

O Model é a classe PHP que representa a sua tabela. Nele, você precisa definir quais colunas podem ser preenchidas em massa.

1.  **Localização:** `app/Models/`
2.  **O que fazer:** Adicione a propriedade `protected $fillable`.

<!-- end list -->

```php
class NomeDoModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'is_active',
    ];
}
```

Isso é uma medida de segurança para evitar que dados indesejados sejam salvos no banco.

-----

## 🧪 Parte 3: Gerenciamento do Banco de Dados

Com a estrutura definida, é hora de interagir com o banco.

### 3.1. Executando as Migrations

Este comando executa todas as migrations que ainda não foram rodadas, criando ou alterando as tabelas no banco.

```bash
php artisan migrate
```

### 3.2. Populando o Banco com Seeders

Seeders são úteis para popular o banco com dados de teste.

```bash
# Roda todos os seus arquivos de Seeders
php artisan db:seed
```

### 3.3. Comando Mágico para Resetar o Ambiente

Em desenvolvimento, é comum querer apagar tudo e recomeçar. Este comando faz isso de forma rápida.

```bash
# APAGA todas as tabelas, roda as MIGRATIONS e depois os SEEDERS
php artisan migrate:fresh --seed
```

> ⚠️ **Atenção:** `migrate:fresh` **DESTRÓI TODOS OS DADOS** do banco. Use apenas em ambiente de desenvolvimento.

-----

## 🧩 Parte 4: Colaboração com Git e GitHub

Trabalhar em equipe exige um fluxo bem definido para compartilhar código.

### 4.1. O Conceito Mais Importante: `.gitignore` e a Pasta `vendor`

Ao clonar um projeto Laravel do GitHub, você notará que a pasta `vendor` (que contém o próprio Laravel e suas dependências) não existe. **Isso é intencional e correto.**

  * **Por que `vendor/` é ignorada?**
    1.  **Tamanho:** A pasta é muito pesada e deixaria o repositório lento.
    2.  **Redundância:** O código não é seu. A lista de tudo que é necessário já está nos arquivos `composer.json` e `composer.lock`.
    3.  **Recriável:** Qualquer pessoa pode recriar a pasta `vendor` de forma idêntica com um único comando.

O erro `Command "serve" is not defined` acontece porque, sem a pasta `vendor`, os comandos do `artisan` não existem.

### 4.2. Fluxo de Trabalho: Configurando um Projeto Clonado

Siga estes passos **toda vez** que baixar o projeto em um novo local:

1.  **Clonar o Repositório**

    ```bash
    git clone <url-do-repositorio>
    cd nome-do-projeto
    ```

2.  **Instalar Dependências (Recriar a pasta `vendor`)**

    ```bash
    composer install
    ```

3.  **Configurar o Arquivo de Ambiente (`.env`)**
    O arquivo `.env` contém senhas e chaves, por isso também é ignorado pelo Git.

    ```bash
    # Copia o arquivo de exemplo para criar o seu .env local
    cp .env.example .env
    ```

4.  **Gerar a Chave da Aplicação**
    Cada instalação precisa de uma chave de segurança única.

    ```bash
    php artisan key:generate
    ```

5.  **Configurar o Banco de Dados no `.env`**
    Abra o arquivo `.env` e ajuste as variáveis de banco de dados (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

6.  **Executar Migrations e Seeders**

    ```bash
    php artisan migrate --seed
    ```

7.  **Iniciar o Servidor**

    ```bash
    php artisan serve
    ```

### 4.3. Fluxo do Dia a Dia

**Para enviar suas alterações (PC de Origem):**

```bash
# Adiciona todos os arquivos modificados
git add .

# Cria um "pacote" de alterações com uma mensagem descritiva
git commit -m "feat: implementa funcionalidade de login"

# Envia o pacote para o repositório no GitHub
git push
```

**Para receber as alterações (PC de Destino):**

```bash
# Baixa as últimas alterações do repositório
git pull

# (Opcional) Se alguém adicionou uma nova biblioteca, atualize as dependências
composer install
```

-----

## ✅ Resumo Rápido (Cheatsheet)

| Comando | O que faz |
| :--- | :--- |
| `composer create-project` | Cria um novo projeto Laravel. |
| `php artisan serve` | Inicia o servidor de desenvolvimento. |
| `php artisan make:model Nome -mc` | Cria Model, Migration e Controller. |
| `php artisan migrate` | Executa as migrations para criar tabelas. |
| `php artisan db:seed` | Popula o banco com dados de teste. |
| `php artisan migrate:fresh --seed` | **APAGA TUDO** e recria o banco do zero. |
| `composer install` | Instala as dependências (recria a pasta `vendor`). |
| `php artisan key:generate` | Gera a chave de segurança no arquivo `.env`. |

-----

> 📌 **Nota para a equipe:** Para pré-visualizar este arquivo `.md` formatado no VSCode, use o atalho `Ctrl + Shift + V`.

## Laravel - Lembretes Rápidos

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

## PHP - Comparações Inline

## ✅ Comparação: `??` vs `?:` vs `if...else`

| Sintaxe                                              | Nome                             | Quando usar                                                                                | Exemplo                                                                 | Equivalente com `if...else`                                              | Resultado                                                |
| ---------------------------------------------------- | -------------------------------- | ------------------------------------------------------------------------------------------ | ----------------------------------------------------------------------- | ------------------------------------------------------------------------ | -------------------------------------------------------- |
| `$x = $a ?? 'valor padrão';`                         | **Null Coalescing** (`??`)       | Quando quer usar um valor **caso não seja `null`**                                         | `$nome = $user->nome ?? 'Anônimo';`                                     | `if ($user->nome !== null) $nome = $user->nome; else $nome = 'Anônimo';` | Usa `$user->nome` se existir, senão `'Anônimo'`          |
| `$x = $a ?: 'valor padrão';`                         | **Ternário simplificado** (`?:`) | Quando quer usar um valor **caso ele não seja "falsy"** (`null`, `false`, `0`, `''`, etc.) | `$nome = $user->nome ?: 'Anônimo';`                                     | `if ($user->nome) $nome = $user->nome; else $nome = 'Anônimo';`          | Usa `$user->nome` se for "verdadeiro", senão `'Anônimo'` |
| `if ($a) { $x = $a; } else { $x = 'valor padrão'; }` | `if...else` tradicional          | Quando precisa de mais controle ou lógica complexa                                         | `if ($user->nome) { $nome = $user->nome; } else { $nome = 'Anônimo'; }` | —                                                                        | Usa `$user->nome` se for "verdadeiro", senão `'Anônimo'` |

---

## 🔍 Diferença principal entre `??` e `?:`

* `??` só verifica se a **variável existe** e **não é `null`**.
* `?:` verifica se a **variável é "falsy"** (vazia, zero, falsa, null, etc.)

---

### ✅ Exemplo prático:

```php
$user->idade = 0;
```

* `{{ $user->idade ?? 'Sem idade' }}` → mostra `0` ✅ (porque `0` **não é null**)
* `{{ $user->idade ?: 'Sem idade' }}` → mostra `'Sem idade'` ❌ (porque `0` é considerado "falsy")

---

## 📌 Quando usar cada um?

| Caso                                                                           | Use         |
| ------------------------------------------------------------------------------ | ----------- |
| Verificar se a variável existe e não é null                                    | `??`        |
| Verificar se a variável tem um valor "verdadeiro" (não vazio, não falso, etc.) | `?:`        |
| Precisa de condições mais complexas ou várias instruções                       | `if...else` |

---

## ✅ Resumo simplificado:

| Código                         | Leitura humana                                                              |
| ------------------------------ | --------------------------------------------------------------------------- |
| `$x = $a ?? 'padrão';`         | Se `$a` não for `null`, usa `$a`, senão usa `'padrão'`                      |
| `$x = $a ?: 'padrão';`         | Se `$a` for verdadeiro (não vazio, não zero...), usa `$a`, senão `'padrão'` |
| `if ($a) { ... } else { ... }` | Quando precisa de lógica mais detalhada                                     |

---

Veja também o [README](..\README.md).