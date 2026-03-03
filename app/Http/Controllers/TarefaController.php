<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::all();
        return view('home', compact('tarefas'));
    }

    public function store(Request $request)
    {
        Tarefa::create($request->all());
        return redirect()->route('dashboard');
    }
}