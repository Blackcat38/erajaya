<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::get('/listuser', [\App\Http\Controllers\API\UserController::class, 'listuser']);
    Route::post('/listuser', [\App\Http\Controllers\API\UserController::class, 'store']);
    Route::get('/listuser/{id}', [\App\Http\Controllers\API\UserController::class, 'show']);
    Route::put('/listuser/{id}', [\App\Http\Controllers\API\UserController::class, 'update']);
    Route::delete('/listuser/{id}', [\App\Http\Controllers\API\UserController::class, 'destroy']);

    Route::get('/listsoal', [\App\Http\Controllers\API\SoalController::class, 'listsoal']);
    Route::get('/randomsoal', [\App\Http\Controllers\API\SoalController::class, 'randomsoal']);
    Route::get('/jawaban', [\App\Http\Controllers\API\SoalController::class, 'jawaban']);
    Route::post('/listsoal', [\App\Http\Controllers\API\SoalController::class, 'store']);
    Route::get('/listsoal/{id}', [\App\Http\Controllers\API\SoalController::class, 'show']);
    Route::put('/listsoal/{id}', [\App\Http\Controllers\API\SoalController::class, 'update']);
    Route::delete('/listsoal/{id}', [\App\Http\Controllers\API\SoalController::class, 'destroy']);

    Route::get('/timer', [\App\Http\Controllers\API\TimerController::class, 'timer']);
    Route::put('/timer/update', [\App\Http\Controllers\API\TimerController::class, 'update']);
});
