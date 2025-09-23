composer create-project laravel/laravel nome-do-projeto --> comando para criar um projeto laravel, na última versão do laravel através do composer

-----
Criando o Model, Migration e Controller 
php artisan make:model Nome-do-model -mc

-->database>migrations> migrate-criada-com-nome-escolhido
[crie as tabelas com $table->tipo(nome);]

php artisan make:controller nome-do-controller --> comando em terminal para a criação de um controller por meio do artisan

abra o Model Criado e insira a linha responsável por armazenamento em massa. 
app>models>nome-do-model 
class nome-do-model extends Model
{
  pretected $fillable =['nome-da-coluna', 'nome-da-coluna']
}
-----
teste
php artisan serve --> exibe as views (para este os assets devem estar em public)
npm run dev --> exibe as views porem sem carregar o back-end (para este os assets devem estar em resources)

o laravel EXIGE o método PUT para ALTERAÇÕES 
o laravel EXIGE o método DELETE para DELETAR algo 

ao utilizar o php artisan serve, os assets devem ficar na pasta public>assets

~~~~ --- ~~~~
para criar um projeto
c:/laravel
c:/Documents/projects_laravel/composer create-project laravel/laravel nome-do-projeto
 
composer create-project laravel/laravel nome-do-projeto
cd nome-do-projeto
 
executando o projeto
php artisan serve
 
criando controller
php artisan make:controller NomeController


Explicação do Gemini sobre o artisan e o gitHub


Olá\! Fique tranquilo, isso que está acontecendo é o comportamento **correto e esperado** ao trabalhar com Laravel e Git. É um ponto crucial no fluxo de trabalho de qualquer desenvolvedor moderno.

Vou te explicar o porquê e como resolver.

### A Causa do "Problema": O Arquivo `.gitignore`

No seu projeto Laravel, existe um arquivo chamado `.gitignore`. Este arquivo é uma lista de todos os arquivos e pastas que o Git deve **ignorar propositalmente**. Ele diz ao Git: "Não rastreie as mudanças nestes itens e não os envie para o repositório no GitHub".

A pasta `vendor` é uma das primeiras e mais importantes nessa lista.

**Por que a pasta `vendor` é ignorada?**

1.  **Tamanho:** A pasta `vendor` contém todas as bibliotecas e dependências do seu projeto (o próprio Laravel, e dezenas de outros pacotes). Ela pode ser muito grande, passando facilmente de 100 MB. Enviar isso para o repositório o deixaria pesado e lento.
2.  **Redundância:** O código na pasta `vendor` não foi escrito por você. É código de terceiros. A lista exata de quais pacotes seu projeto precisa e em qual versão está perfeitamente descrita em dois arquivos que **são** enviados: `composer.json` e `composer.lock`.
3.  **Recriável:** Qualquer pessoa que clonar seu projeto pode recriar a pasta `vendor` de forma idêntica usando os arquivos `composer.json` e `composer.lock`.

O erro ao rodar `php artisan serve` acontece porque, sem a pasta `vendor`, o Laravel simplesmente não existe no projeto. Os arquivos principais da aplicação não conseguem ser carregados.

-----

### A Solução: Usando o Composer

A solução é usar o **Composer**, o gerenciador de dependências do PHP, para instalar tudo o que seu projeto precisa no novo computador.

Siga estes passos no PC onde você clonou o repositório:

**Passo 1: Instalar as Dependências com o Composer**

1.  Abra o terminal (CMD, PowerShell, Git Bash, etc.).
2.  Navegue até a pasta raiz do seu projeto clonado.
    ```bash
    cd caminho/para/seu-projeto
    ```
3.  Execute o seguinte comando:
    ```bash
    composer install
    ```
    Este comando vai ler o arquivo `composer.lock` (ou `composer.json` se o primeiro não existir), baixar todas as dependências necessárias da internet e criar a pasta `vendor` para você.

**Passo 2: Configurar o Arquivo de Ambiente (`.env`)**

Outro arquivo crucial que é ignorado pelo `.gitignore` por razões de segurança é o `.env`. Ele contém senhas de banco de dados, chaves de API e outras informações sensíveis.

1.  No seu projeto, você verá um arquivo chamado `.env.example`. Ele é um modelo. Copie este arquivo e renomeie a cópia para `.env`.

      * No Windows (CMD):
        ```bash
        copy .env.example .env
        ```
      * No Linux ou macOS:
        ```bash
        cp .env.example .env
        ```

2.  Depois de criar o arquivo `.env`, você precisa gerar uma chave de aplicação única para esta instalação. Execute o comando:

    ```bash
    php artisan key:generate
    ```

    Isso irá gerar uma chave segura e colocá-la automaticamente no seu arquivo `.env`.

3.  Abra o arquivo `.env` e configure as variáveis de ambiente, principalmente a conexão com o banco de dados (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), para que funcionem no seu novo PC.

**Passo 3: Rodar o Servidor**

Agora que a pasta `vendor` existe e seu ambiente está configurado, tudo deve funcionar. Tente novamente:

```bash
php artisan serve
```

-----

### Resumo do Fluxo de Trabalho Correto

Para levar seu projeto de um PC para outro, o processo correto é sempre:

1.  **No PC de Origem:**

      * Faça suas alterações no código.
      * Execute `git add .`
      * Execute `git commit -m "Sua mensagem de commit"`
      * Execute `git push` para enviar ao GitHub.

2.  **No PC de Destino:**

      * Execute `git clone <url-do-repositorio>` (apenas na primeira vez).
      * Ou `git pull` se o projeto já foi clonado antes para buscar as atualizações.
      * Execute `composer install` para instalar/atualizar as dependências.
      * Crie e configure seu arquivo `.env` (`cp .env.example .env`).
      * Execute `php artisan key:generate`.
      * Se estiver usando banco de dados, execute `php artisan migrate`.
      * Finalmente, execute `php artisan serve`.