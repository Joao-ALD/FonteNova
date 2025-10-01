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