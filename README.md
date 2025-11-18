<h1 style="color: blue">Projeto FonteNova</h1>

## 🚀 Guia de Instalação e Configuração

Este guia irá orientá-lo sobre como configurar o ambiente de desenvolvimento deste projeto em sua máquina local.

---

## ☁️ MODO RECOMENDADO: CODESPACES (1 CLIQUE)

Este é o método **preferido** e ideal para equipes com restrições de instalação (sem permissão de administrador) ou que buscam ambientes padronizados. Não exige a instalação de PHP, Composer, MySQL ou Docker em sua máquina local. O ambiente completo (incluindo PHP 8.0 fixo, Nginx, MySQL, Redis e Mailpit) é executado na nuvem.

### ✅ Pré-requisitos

Você só precisa de:
* Uma **conta GitHub**
* Um **navegador web** moderno (Chrome, Edge, Firefox) ou o VS Code Desktop.

### ⚙️ Instruções de Inicialização

1.  **Acesse o Repositório:** Vá para a página principal do projeto no GitHub.
2.  **Crie o Codespace:** Clique no botão verde **`< > Code`** (ou `Código`).
3.  Na aba **Codespaces**, clique em **`Create codespace on main`**.
4.  **Aguarde a Automação:** O GitHub levará alguns minutos para provisionar o ambiente. Ele executará automaticamente todo o setup do Laravel (instalação de dependências, `key:generate`, e `migrate --seed`).

### 💻 Como Usar o Ambiente

* **Aplicação:** Assim que o Codespace estiver pronto, ele abrirá o VS Code no navegador. A aplicação estará rodando na porta 80. Clique no link da **Porta 80** (ou use a aba "Portas") para ver a aplicação rodando no seu navegador.
* **Terminal:** O terminal do Codespaces já está conectado ao contêiner PHP 8.0. Você pode rodar comandos Artisan diretamente:
    ```bash
    php artisan [SEU COMANDO] 
    # Ex: php artisan cache:clear
    ```
* **Mailpit (E-mails de Teste):** Verifique e-mails de teste clicando no link da **Porta 8025** (também disponível na aba "Portas").

---

## 🔧 SETUP MANUAL (Opção Alternativa/Local)

Use esta seção **SOMENTE** se você precisa ou prefere rodar o ambiente diretamente em sua máquina local.

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

* 7-zip ou winrar
* Git
* Um SGBD local (ex: MySQL, MariaDB, PostgreSQL, ou XAMPP que já inclui apache e mySql)
* PHP (versão 8.1 ou superior) -> já incluindo no xampp
* Composer (precisa do php para instalar)

---

### ⚙️ Passo a Passo para Instalação

**1. Clonar o Repositório**
Use o comando abaixo no terminal ou a sua extensão favorita do VS Code para clonar o projeto.

```bash
git clone https://URL_DO_SEU_REPOSITORIO.git
````

Depois, entre na pasta do projeto:

```bash
cd nome-do-projeto
```

**2. Atualizar o composer para a última versão**
Execute o Composer update para atualizar o composer para a última versão.

```bash
composer update
```

**3. Instalar as Dependências do PHP**
Execute o Composer para baixar todas as bibliotecas necessárias que ficam na pasta `vendor/`.

```bash
composer install
```

**4. Criar o Arquivo de Ambiente (`.env`)**
Este arquivo é uma cópia do arquivo de exemplo `.env.example`.

  * Se estiver no **Windows (CMD/PowerShell)**:
    ```bash
    copy .env.example .env
    ```
  * Se estiver no **Linux ou macOS**:
    ```bash
    cp .env.example .env
    ```

**5. Gerar a Chave da Aplicação**
O Laravel precisa de uma chave de encriptação única. Este comando irá gerá-la e inseri-la automaticamente no seu arquivo `.env`.

```bash
php artisan key:generate
```

**6. Configurar o Banco de Dados**

  - Crie um novo banco de dados no seu SGBD local (MySQL, etc.).
  - Abra o arquivo `.env` que você acabou de criar.
  - Encontre as seguintes linhas e atualize com as informações do seu banco de dados local:

<!-- end list -->

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fontenova
DB_USERNAME=root
DB_PASSWORD=""
```

**7. Executar as "Migrations" e "Seeders"**
Este comando irá criar todas as tabelas necessárias no banco de dados e populá-las com dados iniciais, como os estados e iniciativas para o mapa interativo.

```bash
php artisan migrate --seed
```

**8. Iniciar o Servidor de Desenvolvimento**
Pronto\! Agora você pode iniciar o servidor local do Laravel.

```bash
php artisan serve
```

Abra seu navegador e acesse [http://127.0.0.1:8000](http://127.0.0.1:8000) para ver a aplicação funcionando.

Para mais informações, veja o [Guia de Comandos Laravel e Git](https://www.google.com/search?q=lembretes/Guia_Comandos_Laravel_Git.md) para ver os comandos mais usados e o [Guia Completo Laravel](https://www.google.com/search?q=lembretes/Guia_Completo_Laravel_Git.md) para informações mais detalhadas.