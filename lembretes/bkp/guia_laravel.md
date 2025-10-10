
# 🌐 Guia Completo de Laravel

Laravel é um **framework PHP** baseado no padrão **MVC (Model-View-Controller)** que facilita o desenvolvimento de aplicações web robustas, seguras e escaláveis.

---

## 🚀 Conceitos Fundamentais

### 🔹 MVC
- **Model**: Representa os dados e a lógica de negócios (interage com o banco de dados).
- **View**: Camada de apresentação (HTML, Blade templates).
- **Controller**: Camada intermediária que recebe requisições, chama os Models e retorna as Views.

### 🔹 Artisan
- Interface de linha de comando do Laravel.
- Facilita a criação de models, controllers, migrations, seeds, etc.

### 🔹 Migrations
- Sistema de versionamento para banco de dados.
- Permite criar e alterar tabelas de forma controlada.

### 🔹 Eloquent ORM
- ORM nativo do Laravel.
- Permite manipular dados com PHP em vez de SQL puro.

### 🔹 Blade
- Engine de templates do Laravel.
- Permite reaproveitamento de layouts e lógica simples dentro das views.

---

## 📦 Estrutura do Projeto (principais pastas)

- `app/` → Contém os Models, Controllers, Services, etc.  
- `routes/` → Onde ficam as rotas da aplicação.  
- `resources/views/` → Onde ficam as Views (arquivos `.blade.php`).  
- `database/migrations/` → Scripts de criação/alteração do banco de dados.  
- `public/` → Arquivos públicos (CSS, JS, imagens).  

---

## ⚡ Fluxo de uma Requisição

1. O usuário acessa uma **rota** definida em `routes/web.php`.  
2. A rota chama um **Controller**.  
3. O Controller interage com um **Model** (se necessário).  
4. O Controller retorna uma **View** ou JSON (em APIs).  

---

## 🛠️ Comandos Artisan Importantes

```bash
# Criar novo projeto Laravel
composer create-project laravel/laravel nome_projeto

# Servidor local
php artisan serve

# Criar controller
php artisan make:controller NomeController

# Criar model
php artisan make:model NomeModel

# Criar migration
php artisan make:migration create_nome_tabela_table

# Rodar migrations
php artisan migrate

# Criar seeder
php artisan make:seeder NomeSeeder

# Rodar seeders
php artisan db:seed
```

---

## ✅ Boas Práticas

1. **Organização**: siga a arquitetura MVC corretamente.  
2. **Validação**: valide sempre os dados antes de salvar no banco.  
3. **Env**: nunca exponha credenciais (`.env` deve estar no `.gitignore`).  
4. **Migrations**: use migrations em vez de alterar tabelas manualmente.  
5. **Eloquent**: prefira Eloquent em vez de SQL cru.  
6. **Reutilização**: use componentes Blade e middlewares para não repetir código.  
7. **Segurança**: utilize CSRF, autenticação e criptografia padrão do Laravel.  

---

## 🌟 Exemplo Simples

### Rota (`routes/web.php`)
```php
Route::get('/usuarios', [UsuarioController::class, 'index']);
```

### Controller (`app/Http/Controllers/UsuarioController.php`)
```php
class UsuarioController extends Controller {
    public function index() {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }
}
```

### View (`resources/views/usuarios/index.blade.php`)
```blade
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Usuários</h1>
    <ul>
        @foreach ($usuarios as $usuario)
            <li>{{ $usuario->nome }}</li>
        @endforeach
    </ul>
</body>
</html>
```

---

# 📌 Versão Resumida (Lembretes)

### 🚀 Comandos Úteis
```bash
php artisan serve        # rodar servidor
php artisan migrate      # aplicar migrations
php artisan make:model X # criar model
php artisan make:controller XController # criar controller
php artisan make:migration create_xxx_table # criar migration
php artisan db:seed      # rodar seeders
```

### 🔹 Estrutura
- `routes/web.php` → rotas web  
- `app/Models` → models  
- `app/Http/Controllers` → controllers  
- `resources/views` → views (Blade)  
- `database/migrations` → migrations  

### 🔹 Fluxo
Rota → Controller → Model → View  