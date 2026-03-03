<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::all();

        $total = $tarefas->count();
        $concluidas = $tarefas->where('status', 'Concluído')->count();
        $emAndamento = $tarefas->where('status', 'Em andamento')->count();
        $atrasadas = $tarefas->where('status', 'Atrasado')->count();

        $produtividade = $total > 0
            ? round(($concluidas / $total) * 100)
            : 0;

        return view('home', compact(
            'tarefas',
            'total',
            'concluidas',
            'emAndamento',
            'atrasadas',
            'produtividade'
        ));
    }

    public function store(Request $request)
    {
        Tarefa::create($request->all());

        return redirect('/');
    }
}