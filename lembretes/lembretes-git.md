# 📝 Guia Básico de Git e GitHub

Este documento lista os principais **termos e comandos** usados no Git e no GitHub, explicando de forma simples para iniciantes.

---

## 📚 Termos Importantes

- **Repositório (Repository)**  
  Local onde o projeto e seu histórico de versões são armazenados. Pode ser local (na sua máquina) ou remoto (no GitHub).

- **Branch**  
  É uma ramificação do código. Permite trabalhar em novas funcionalidades sem alterar o código principal (geralmente o branch principal se chama `main` ou `master`).

- **Commit**  
  É como um “salvamento” do estado atual dos arquivos. Cada commit tem uma mensagem que descreve o que foi alterado.

- **Merge**  
  Junta as alterações de um branch em outro. Muito usado para juntar alterações do branch de desenvolvimento ao `main`.

- **Pull Request (PR)**  
  Pedido para mesclar (merge) as alterações de um branch para outro no GitHub. Serve para que outros possam revisar antes de juntar.

- **Fork**  
  Uma cópia de um repositório de outra pessoa para a sua conta no GitHub. Muito usado para contribuir em projetos de terceiros.

- **Clone**  
  Copiar um repositório remoto (do GitHub) para a sua máquina local.

- **Origin**  
  Nome padrão dado ao repositório remoto que está conectado ao seu projeto local.

- **HEAD**  
  Aponta para o commit atual em que você está trabalhando.

---

## 💻 Comandos Básicos do Git

- `git init`  
  Inicializa um novo repositório Git na pasta atual.

- `git clone <url>`  
  Faz o download (clone) de um repositório remoto para a sua máquina.

- `git status`  
  Mostra o estado atual dos arquivos (quais foram modificados, adicionados, etc).

- `git add <arquivo>`  
  Adiciona arquivos modificados para a área de preparação (stage).  
  Use `git add .` para adicionar todos os arquivos modificados.

- `git commit -m "mensagem"`  
  Cria um commit com os arquivos adicionados, salvando as alterações localmente.

- `git push`  
  Envia os commits do repositório local para o repositório remoto (GitHub).

- `git pull`  
  Atualiza o repositório local com as alterações feitas no repositório remoto.

- `git branch`  
  Lista todos os branches existentes e mostra em qual você está.  
  Use `git branch <nome>` para criar um novo branch.

- `git checkout <nome-do-branch>`  
  Troca para outro branch.  
  Use `git checkout -b <nome>` para criar e já mudar para um novo branch.

- `git merge <nome-do-branch>`  
  Junta as alterações de outro branch no branch atual.

- `git log`  
  Mostra o histórico de commits do projeto.

---

## ✅ Dicas Rápidas

- Faça commits frequentes e com mensagens claras.  
- Sempre atualize seu repositório local (`git pull`) antes de começar a trabalhar.  
- Use branches para trabalhar em novas funcionalidades.  
- Use Pull Requests no GitHub para que todos possam revisar o código antes de juntar no `main`.
