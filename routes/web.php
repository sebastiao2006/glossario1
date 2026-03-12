<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;

Route::get('/', [TarefaController::class, 'index'])->name('home');

Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');

Route::post('/tarefas/{id}/concluir', [TarefaController::class, 'concluir'])->name('tarefas.concluir');

Route::delete('/tarefas/{id}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');

Route::get('/tarefas/{id}/edit', [TarefaController::class, 'edit'])->name('tarefas.edit');

Route::put('/tarefas/{id}', [TarefaController::class, 'update'])->name('tarefas.update');

Route::get('/clientes', [ClienteController::class, 'index']);

Route::post('/clientes', [ClienteController::class, 'store']);

Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('/funcionarios', [FuncionarioController::class, 'index']);

Route::post('/funcionarios', [FuncionarioController::class, 'store']);

Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');

Route::get('/tarefas', [TarefaController::class, 'indexTarefas'])->name('tarefas.index');