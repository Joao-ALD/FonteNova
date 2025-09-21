<?php

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AguaController;
use Illuminate\Support\Facades\Route;

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
Route::get('/infoAgua', [AguaController::class, 'index'])->name('agua.index');

// Rotas ChatBot
Route::get('/ChatBot', [ChatBotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/responder', [ChatbotController::class, 'responder'])->name('chatbot.responder');

