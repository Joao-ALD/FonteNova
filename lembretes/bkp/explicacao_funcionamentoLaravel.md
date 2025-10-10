# Explicação do Funcionamento e Conexão dos Arquivos

Imagine que um usuário digita `http://seu-projeto.test/posts` no navegador. Veja o caminho que essa requisição faz dentro do Laravel:

## 1. Entrada (routes/web.php): O Porteiro
O Laravel verifica as rotas e encontra a definição:
```php
Route::resource('posts', PostController::class);
```
Isso redireciona requisições de `/posts` para o PostController, chamando `index()` no caso de GET.

## 2. Lógica (app/Http/Controllers/PostController.php): O Gerente
O método `index()` busca os posts via Model com:
```php
$posts = Post::all();
```
Ele é responsável pela lógica.

## 3. Dados (app/Models/Post.php): O Especialista em Dados
O Model `Post` representa a tabela `posts`. Ele executa a query `SELECT * FROM posts`.  
Sua estrutura é definida nas migrations.

## 4. De volta ao Controller (PostController.php)
Agora o Controller envia os dados para a View:
```php
return view('posts.index', ['posts' => $posts]);
```

## 5. Apresentação (resources/views/posts/index.blade.php): O Designer
O Blade recebe os dados e renderiza o HTML final, usando loops e variáveis.

## 6. Resultado Final: O Navegador
O HTML compilado é enviado ao navegador, que exibe a página.

---

**Resumo do Fluxo:**  
`Rota → Controller → Model (que sabe da Migration) → Controller → View → Navegador`
