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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/sobre',[SobreController::class, 'index'])->name('sobre.index');
Route::get('/infoAgua', [AguaController::class, 'index'])->name('agua.index');
Route::get('/quizz', [QuizzController::class, 'index'])->name('quizz.index');
Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria.index');
Route::get('/curso', [CursoController::class, 'index'])->name('curso.index');


// Rotas ChatBot
// Rotas do ChatBot (padronizadas em lowercase e com referência correta ao controller)
Route::get('/chatbot', [ChatBotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/responder', [ChatBotController::class, 'responder'])->name('chatbot.responder');

// Rota para o mapa interativo
Route::get('/mapa', [MapaController::class, 'index'])->name('mapa.index');
Route::get('/mapa/info/{estado}', [MapaController::class, 'getEstadoInfo'])->name('mapa.info');

//Rota Cursos
Route::get('/cursos', [CursoController::class, 'index'])->name('curso.index');
Route::get('/cursos/{aula}', [CursoController::class, 'mostrarAula'])->name('curso.aula');