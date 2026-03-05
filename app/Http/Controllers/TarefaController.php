<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;

class TarefaController extends Controller
{

    public function index()
    {
        $tarefas = Tarefa::all();

        $clientes = Tarefa::select('cliente')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('GROUP_CONCAT(DISTINCT funcionario) as responsaveis')
            ->groupBy('cliente')
            ->get();

        // CARDS
        $totalTasks = Tarefa::count();
        $completedTasks = Tarefa::where('status', 'like', '%Conclu%')->count();

        $inProgressTasks = Tarefa::where('status', 'like', '%andamento%')->count();

        $overdueTasks = Tarefa::where('status', 'like', '%Atras%')->count();

        // produtividade (% tarefas concluídas)
        $productivity = $totalTasks > 0 
            ? round(($completedTasks / $totalTasks) * 100) 
            : 0;

        return view('home', compact(
            'tarefas',
            'clientes',
            'totalTasks',
            'completedTasks',
            'inProgressTasks',
            'overdueTasks',
            'productivity'
        ));
    }

    public function store(Request $request)
    {

        Tarefa::create([
            'funcionario' => $request->funcionario,
            'cliente' => $request->cliente,
            'tipo' => $request->tipo,
            'prioridade' => $request->prioridade,
            'inicio' => $request->inicio,
            'prazo' => $request->prazo,
            'status' => $request->status,
        ]);

        return redirect()->route('home');
    }

    public function concluir($id)
{
    $tarefa = Tarefa::find($id);

    $tarefa->status = "Concluído";

    $tarefa->save();

    return redirect()->route('home');
}

public function destroy($id)
{
    Tarefa::destroy($id);

    return redirect()->route('home');
}


public function edit($id)
{
    $tarefa = Tarefa::find($id);

    return view('editar',compact('tarefa'));
}

public function update(Request $request,$id)
{
    $tarefa = Tarefa::find($id);

    $tarefa->update([
        'funcionario'=>$request->funcionario,
        'cliente'=>$request->cliente,
        'tipo'=>$request->tipo,
        'prioridade'=>$request->prioridade,
        'inicio'=>$request->inicio,
        'prazo'=>$request->prazo,
        'status'=>$request->status
    ]);

    return redirect()->route('home');
}

}