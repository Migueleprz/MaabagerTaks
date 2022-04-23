<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DependeciaController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\TrabajadorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[AuthController::class, 'registro']);
Route::post('/login',[AuthController::class, 'iniciarSesion']);


Route::middleware('auth.api')->group(function () {
    Route::resource('dependencia', DependeciaController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('trabajador', TrabajadorController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('tarea', TareaController::class)->only(['index','store', 'show', 'update', 'destroy']);
    Route::get('/tareas/{status?}',[TareaController::class, 'getTareas']);
    Route::put('/task/{tarea}',[TareaController::class, 'updateStatus']);
});
