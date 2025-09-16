<h1 style="color: blue">Projeto FonteNova</h1>

## 🚀 Guia de Instalação e Configuração

Este guia irá orientá-lo sobre como configurar o ambiente de desenvolvimento deste projeto em sua máquina local.

### 🤔 Por que estes passos são necessários?

Ao trabalhar com projetos modernos em equipe usando Git, alguns arquivos e pastas são **intencionalmente ignorados** e não são enviados para o repositório no GitHub. Isso é controlado por um arquivo chamado `.gitignore`. Os dois principais motivos são:

1.  **Segurança (Arquivo `.env`):** O arquivo `.env` contém informações sensíveis e específicas de cada ambiente, como senhas de banco de dados e chaves de API. Jamais devemos compartilhar essas informações no repositório. Cada desenvolvedor cria e configura seu próprio arquivo `.env` localmente.

2.  **Eficiência (Pasta `vendor/`):** Esta pasta contém todas as bibliotecas de terceiros (dependências) que o projeto usa, incluindo o próprio Laravel. Ela pode ser muito grande e pesada. Em vez de enviar essa pasta, nós enviamos apenas um "mapa", o arquivo `composer.json`, que lista tudo o que é necessário. O comando `composer install` usa esse mapa para baixar e instalar tudo na sua máquina.

Seguindo os passos abaixo, você irá recriar esses arquivos e configurar o projeto para rodar corretamente.

### 💡 Dica: Usando Extensões do VS Code

Muitos de nós usamos extensões no VS Code **(como a aba "GitGraph (Source Control)", GitLens, GitHub Pull Requests, etc.)** para facilitar o trabalho com o Git. Elas são ótimas para clonar, visualizar alterações, fazer commits e enviar seu código (`push`).

Você pode perfeitamente usar sua extensão preferida para realizar o **Passo 1 (Clonar o Repositório)**.

No entanto, é importante lembrar que essas extensões gerenciam apenas o versionamento do código (o trabalho do Git). Elas **não substituem** a necessidade de usar o terminal para os comandos de configuração do projeto, como `composer install` e `php artisan`.

**Resumindo:** Use a extensão para o Git, e o terminal para o setup do Laravel!

---

### 🔧 Pré-requisitos

Antes de começar, garanta que você tenha os seguintes softwares instalados na sua máquina:

* PHP (versão 8.1 ou superior)
* Composer
* Git
* Um SGBD local (ex: MySQL, MariaDB, PostgreSQL, ou XAMPP que já inclui apache e mySql )

---

### ⚙️ Passo a Passo para Instalação

**1. Clonar o Repositório**
   Use o comando abaixo no terminal ou a sua extensão favorita do VS Code para clonar o projeto.

   ```bash
   git clone https://URL_DO_SEU_REPOSITORIO.git
   ```

   Depois, entre na pasta do projeto:

   ```bash
   cd nome-do-projeto
   ```

**2. Instalar as Dependências do PHP**
   Execute o Composer para baixar todas as bibliotecas necessárias que ficam na pasta `vendor/`.

   ```bash
   composer install
   ```

**3. Criar o Arquivo de Ambiente (`.env`)**
   Este arquivo é uma cópia do arquivo de exemplo `.env.example`.

   * Se estiver no **Windows (CMD/PowerShell)**:
       ```bash
       copy .env.example .env
       ```
   * Se estiver no **Linux ou macOS**:
       ```bash
       cp .env.example .env
       ```

**4. Gerar a Chave da Aplicação**
   O Laravel precisa de uma chave de encriptação única. Este comando irá gerá-la e inseri-la automaticamente no seu arquivo `.env`.

   ```bash
   php artisan key:generate
   ```

**5. Configurar o Banco de Dados**
   - Crie um novo banco de dados no seu SGBD local (MySQL, etc.).
   - Abra o arquivo `.env` que você acabou de criar.
   - Encontre as seguintes linhas e atualize com as informações do seu banco de dados local:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=fontenova
   DB_USERNAME=root
   DB_PASSWORD=""
   ```

**--NÃO EXECUTAR POR AGORA --6. Executar as "Migrations"**
   Este comando irá criar todas as tabelas necessárias no banco de dados que você acabou de configurar.

   ```bash
   ~~php artisan migrate~~
   ```
**--**
**7. Iniciar o Servidor de Desenvolvimento**
   Pronto! Agora você pode iniciar o servidor local do Laravel.

   ```bash
   php artisan serve
   ```

   Abra seu navegador e acesse [http://127.0.0.1:8000](http://127.0.0.1:8000) para ver a aplicação funcionando.
