<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefaController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/', [TarefaController::class, 'index'])->name('dashboard');
Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
