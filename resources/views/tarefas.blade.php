<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Tarefas</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
<script src="{{ asset('js/script.js') }}" defer></script>
<style>

    .formu{
        background:white;
        padding:30px;          /* aumentou o espaço interno */
        border-radius:8px;
        margin:20px 0 40px 0;  /* margem em cima e embaixo */
    }
    .btn-pdf{
    background:#e74c3c;
    color:white;
    padding:6px 10px;
    text-decoration:none;
    border-radius:4px;
    }
    input{
        width:100%;
        padding:12px;
        margin-top:12px;
        margin-bottom:18px;    /* um pouco mais de espaço entre campos */
        border:1px solid #ddd;
        border-radius:5px;
    }

    button{
        background:#feae1b;
        color:white;
        border:none;
        padding:12px 24px;     /* botão um pouco maior */
        border-radius:5px;
        cursor:pointer;
    }

</style>
</head>
<body>

@include('header')

<div class="container">

    <!-- BOTÃO -->
    {{-- <button id="showFormBtn">+ Adicionar Tarefa</button> --}}

<h2>Adicionar Nova Tarefa</h2>

<form class="formu" method="POST" action="{{ route('tarefas.store') }}">
@csrf

<select name="funcionario" required>

<option value="">Selecionar Funcionário</option>

@foreach($funcionarios as $funcionario)

<option value="{{ $funcionario->nome }}">
{{ $funcionario->nome }}
</option>

@endforeach

</select>

<select name="cliente" required>

<option value="">Selecionar Cliente</option>

@foreach($clientes as $cliente)

<option value="{{ $cliente->nome }}">
{{ $cliente->nome }}
</option>

@endforeach

</select>

<input type="text" name="tipo" placeholder="Tipo" required>

<select name="prioridade" required>
<option value="">Prioridade</option>
<option value="Alta">Alta</option>
<option value="Média">Média</option>
<option value="Baixa">Baixa</option>
</select>

<input type="date" name="inicio" min="2025-12-12" max="2026-12-12" required>

<input type="date" name="prazo" min="2025-12-12" max="2026-12-12" required>

<select name="status" required>
<option value="">Status</option>
<option value="Pendente">Pendente</option>
<option value="Em andamento">Em andamento</option>
<option value="Concluído">Concluído</option>
<option value="Atrasado">Atrasado</option>
</select>

<button type="submit">Adicionar Tarefa</button>

</form>
    <!-- TABELA DE TAREFAS -->
    <h3>Controle de Tarefas</h3>
<a href="{{ route('tarefas.pdf.all') }}" class="btn-pdf" style="display:inline-block; margin-bottom:20px;">
Baixar PDF Geral
</a>
    
    <table>
        <thead>
            <tr>
                <th>Funcionário</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Prioridade</th>
                <th>Início</th>
                <th>Prazo</th>
                <th>Status</th>
                <th>Alerta</th>
                <th>Progresso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tarefas as $tarefa)
            <tr>
                <td>{{ $tarefa->funcionario }}</td>
                <td>{{ $tarefa->cliente }}</td>
                <td>{{ $tarefa->tipo }}</td>
                <td>{{ $tarefa->prioridade }}</td>
                <td>{{ \Carbon\Carbon::parse($tarefa->inicio)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($tarefa->prazo)->format('d/m/Y') }}</td>
                <td>{{ $tarefa->status }}</td>
                <td>
                    @php
                    $hoje = \Carbon\Carbon::today();
                    $prazo = \Carbon\Carbon::parse($tarefa->prazo);
                    @endphp

                    @if($prazo->lt($hoje) && $tarefa->status != "Concluído")
                        <span class="alerta atraso">🔴 Atrasado</span>
                    @elseif($prazo->isSameDay($hoje) && $tarefa->status != "Concluído")
                        <span class="alerta hoje">🟡 Vence Hoje</span>
                    @else
                        <span class="alerta ok">🟢 No Prazo</span>
                    @endif
                </td>
                <td>
                    @if($tarefa->status == "Concluído")
                        <div class="progress-bar"><div class="progress" style="width:100%"></div></div>
                    @elseif($tarefa->status == "Em andamento")
                        <div class="progress-bar"><div class="progress yellow" style="width:50%"></div></div>
                    @else
                        <div class="progress-bar"><div class="progress red" style="width:10%"></div></div>
                    @endif
                </td>
                <td>
                    <form action="{{ route('tarefas.concluir',$tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn-concluir">Concluir</button>
                    </form>
                    {{-- <a href="{{ route('tarefas.edit',$tarefa->id) }}" class="btn-editar">Editar</a> --}}
                    <a href="{{ route('tarefas.pdf.one',$tarefa->id) }}" class="btn-pdf">PDF</a>
                    <form action="{{ route('tarefas.destroy',$tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- JS DA MODAL -->
{{-- <script>
    var modal = document.getElementById("taskModal");
    var btn = document.getElementById("showFormBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script> --}}

</body>
</html>