<?php

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AguaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EbookProgressController;
use App\Http\Controllers\AdminQuizzController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ROTAS PÚBLICAS (Todos podem ver) ---
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/sobre', [SobreController::class, 'index'])->name('sobre.index');
Route::get('/infoAgua', [AguaController::class, 'index'])->name('agua.index');
Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');


// Rota da Página Inicial (Biblioteca)-Ebook e Rota do Leitor (Reader)-pagina de leitura do Ebook
Route::get('/ebooks', [EbookController::class, 'index'])->name('ebooks.index');
Route::get('/ebooks/{id}/reader', [EbookController::class, 'reader'])->name('ebooks.reader');

// Rotas ChatBot
Route::get('/chatbot', [ChatBotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/responder', [ChatBotController::class, 'responder'])->name('chatbot.responder');

// Rota para o mapa interativo
Route::get('/mapa', [MapaController::class, 'index'])->name('mapa.index');
Route::get('/mapa/info/{estado}', [MapaController::class, 'getEstadoInfo'])->name('mapa.info');


// --- ROTAS PROTEGIDAS (Exigem Login) ---
// O middleware 'auth' força o usuário a estar logado.
// Se não estiver, ele é redirecionado para a página de login.
Route::middleware(['auth'])->group(function () {

    // Rotas de Curso
    Route::get('/curso', [CursoController::class, 'index'])->name('curso.index'); // <-- Protegida
    Route::get('/cursos', [CursoController::class, 'index'])->name('curso.index'); // <-- Protegida
    Route::get('/cursos/{aula}', [CursoController::class, 'mostrarAula'])->name('curso.aula'); // <-- Protegida

    // Rotas do Quizz
    Route::get('/quizz', [QuizzController::class, 'index'])->name('quizz.index'); // <-- Protegida

    
    // O Breeze cria uma rota de 'dashboard' por padrão. 
    // Você pode usá-la ou deletá-la se não precisar.
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// GRUPO DE ROTAS ADMINISTRATIVAS (Protegidas por login)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/cursos', [CursoController::class, 'adminIndex'])->name('admin.cursos.index');
    Route::get('/cursos/{id}/editar', [CursoController::class, 'edit'])->name('admin.cursos.edit');
    Route::put('/cursos/{id}', [CursoController::class, 'update'])->name('admin.cursos.update');
    // Rotas para Gerenciamento do Quizz (Usando Resource para cobrir CRUD)
    Route::resource('quizz', AdminQuizzController::class)
        ->names('admin.quizz')
        ->parameters(['quizz' => 'pergunta'])
        ->except(['show']);

});



// --- ROTAS DE AUTENTICAÇÃO ---
// Esta linha foi adicionada pelo Breeze e controla /login, /register, /logout, etc.
require __DIR__ . '/auth.php';



