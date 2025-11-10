<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EstadoController;
use App\Http\Controllers\Api\IniciativaController;
use App\Http\Controllers\Api\EstatisticasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/estados', [EstadoController::class, 'index']);
Route::get('/estados/{uf}', [EstadoController::class, 'show']);
Route::get('/estados/{uf}/iniciativas', [IniciativaController::class, 'porEstado']);
Route::get('/iniciativas', [IniciativaController::class, 'index']);
Route::get('/iniciativas/search', [IniciativaController::class, 'index']);
Route::get('/estatisticas', [EstatisticasController::class, 'index']);
