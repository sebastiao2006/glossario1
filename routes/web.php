<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefaController;

Route::get('/', [HomeController::class, 'index']);


Route::get('/', [TarefaController::class, 'index'])->name('home');

Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');

Route::post('/tarefas/{id}/concluir',[TarefaController::class,'concluir'])->name('tarefas.concluir');

Route::delete('/tarefas/{id}',[TarefaController::class,'destroy'])->name('tarefas.destroy');

Route::get('/tarefas/{id}/edit',[TarefaController::class,'edit'])->name('tarefas.edit');

Route::put('/tarefas/{id}',[TarefaController::class,'update'])->name('tarefas.update');