<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Cliente;
use App\Models\Funcionario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class TarefaController extends Controller
{
public function index(Request $request)
{
    $query = Tarefa::query();

    // FILTRO FUNCIONÁRIO
    if($request->funcionario){
        $query->where('funcionario', $request->funcionario);
    }

    // FILTRO STATUS
    if($request->status){
        $query->where('status', $request->status);
    }

    // FILTRO PERÍODO
    if($request->periodo){

        if($request->periodo == 'Semana'){
            $query->where('created_at','>=',now()->subDays(7));
        }

        if($request->periodo == 'Mes'){
            $query->where('created_at','>=',now()->subDays(30));
        }
    }

    $tarefas = $query->get();

    // CLIENTES
$clientes = Tarefa::select(
        'cliente',
        DB::raw('COUNT(*) as total'),
        DB::raw('GROUP_CONCAT(DISTINCT funcionario) as responsaveis'),
        DB::raw("
            CASE
                WHEN SUM(CASE WHEN status = 'Em andamento' THEN 1 ELSE 0 END) > 0 THEN 'Em andamento'
                WHEN SUM(CASE WHEN status = 'Pendente' THEN 1 ELSE 0 END) > 0 THEN 'Pendente'
                ELSE 'Concluído'
            END as status
        ")
    )
    ->groupBy('cliente')
    ->get();

    // FUNCIONÁRIOS
    $funcionarios = Tarefa::select('funcionario')
        ->distinct()
        ->get();

    // CARDS
    $totalTasks = $tarefas->count();
    $completedTasks = $tarefas->where('status','Concluído')->count();
    $inProgressTasks = $tarefas->where('status','Em andamento')->count();
    $overdueTasks = $tarefas->where('status','Atrasado')->count();

    $productivity = $totalTasks > 0 
        ? round(($completedTasks / $totalTasks) * 100)
        : 0;

    // ALERTAS AUTOMÁTICOS
    $alerts = [];

foreach($tarefas as $tarefa){

    if($tarefa->status == "Atrasado"){
        $alerts[] = "⚠️ Tarefa do cliente {$tarefa->cliente} está atrasada.";
    }

    if($tarefa->prazo && $tarefa->status != "Concluído"){

        $dias = now()->diffInDays($tarefa->prazo, false);

        if($dias == 1){
            $alerts[] = "⏰ Tarefa do cliente {$tarefa->cliente} vence amanhã.";
        }

        if($dias == 0){
            $alerts[] = "🚨 Tarefa do cliente {$tarefa->cliente} vence hoje.";
        }

        if($dias < 0){
            $alerts[] = "❗ Tarefa do cliente {$tarefa->cliente} está atrasada.";
        }
    }
}

// RANKING FUNCIONÁRIOS (tarefas concluídas)

$ranking = Tarefa::select('funcionario', DB::raw('count(*) as total'))
    ->where('status','Concluído')
    ->groupBy('funcionario')
    ->orderByDesc('total')
    ->get();

return view('home', compact(
    'tarefas',
    'clientes',
    'funcionarios',
    'totalTasks',
    'completedTasks',
    'inProgressTasks',
    'overdueTasks',
    'productivity',
    'alerts',
    'ranking'
));


    
}

public function indexTarefas()
{
    $tarefas = Tarefa::all();

    $clientes = Cliente::all();

    $funcionarios = Funcionario::all();

    return view('tarefas', compact('tarefas', 'clientes', 'funcionarios'));
}

    public function store(Request $request)
{
    $request->validate([
        'funcionario' => 'required|string',
        'cliente' => 'required|string',
        'tipo' => 'required|string',
        'prioridade' => 'required',
        'inicio' => 'required|date|after_or_equal:2025-12-12|before_or_equal:2026-12-12',
        'prazo' => 'required|date|after_or_equal:inicio|before_or_equal:2026-12-12',
        'status' => 'required'
    ]);

    Tarefa::create([
        'funcionario' => $request->funcionario,
        'cliente' => $request->cliente,
        'tipo' => $request->tipo,
        'prioridade' => $request->prioridade,
        'inicio' => $request->inicio,
        'prazo' => $request->prazo,
        'status' => $request->status,
    ]);

    return redirect()->route('tarefas.index');
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
    $request->validate([
        'inicio' => 'required|date|after_or_equal:2025-12-12|before_or_equal:2026-12-12',
        'prazo' => 'required|date|after_or_equal:inicio|before_or_equal:2026-12-12'
    ]);

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
public function create()
{
    $clientes = Cliente::all();
    return view('tarefas.create', compact('clientes'));
}

public function pdfAll()
{
    $tarefas = Tarefa::all();

    $pdf = Pdf::loadView('pdf.tarefas', compact('tarefas'));

    return $pdf->download('lista_tarefas.pdf');
}

public function pdfOne($id)
{
    $tarefa = Tarefa::findOrFail($id);

    $pdf = Pdf::loadView('pdf.tarefa', compact('tarefa'));

    return $pdf->download('tarefa_'.$tarefa->id.'.pdf');
}

}