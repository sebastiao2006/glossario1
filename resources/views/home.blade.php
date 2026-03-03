<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Controle de Tarefas</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
<script src="{{ asset('js/script.js') }}" defer></script>
</head>

<body>

<header>
    <div class="header-title">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Dashboard de Tarefas - Empresa de Contabilidade</h2>
    </div>
</header>

<div class="container">

<!-- BOTÃO -->
<button id="showFormBtn" class="btn-open">+ Adicionar Tarefa</button>

<!-- OVERLAY -->
<div id="overlay" class="overlay">

    <div class="modal">

        <div class="modal-header">
            <h3>Adicionar Nova Tarefa</h3>
            <button id="closeFormBtn" class="close-btn">&times;</button>
        </div>

        <form action="{{ route('tarefas.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="funcionario">Funcionário</label>
                <input type="text" id="funcionario" name="funcionario" required>
            </div>

            <div class="form-group">
                <label for="cliente">Cliente</label>
                <input type="text" id="cliente" name="cliente" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo de Tarefa</label>
                <input type="text" id="tipo" name="tipo" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="prioridade">Prioridade</label>
                    <select id="prioridade" name="prioridade">
                        <option value="Alta">Alta</option>
                        <option value="Média">Média</option>
                        <option value="Baixa">Baixa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="Pendente">Pendente</option>
                        <option value="Em andamento">Em andamento</option>
                        <option value="Concluído">Concluído</option>
                        <option value="Atrasado">Atrasado</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="inicio">Data de Início</label>
                    <input type="date" id="inicio" name="inicio">
                </div>

                <div class="form-group">
                    <label for="prazo">Prazo</label>
                    <input type="date" id="prazo" name="prazo">
                </div>
            </div>

            <button type="submit" class="btn-submit">Salvar Tarefa</button>
        </form>

    </div>
</div>

    <!-- CARDS -->
    <div class="cards">
        <div class="card"><h3>Total de Tarefas</h3><p id="totalTasks">0</p></div>
        <div class="card"><h3>Concluídas</h3><p id="completedTasks">0</p></div>
        <div class="card"><h3>Em Andamento</h3><p id="inProgressTasks">0</p></div>
        <div class="card"><h3>Atrasadas</h3><p id="overdueTasks">0</p></div>
        <div class="card"><h3>Produtividade</h3><p id="productivity">0%</p></div>
    </div>

    <!-- FILTROS -->
    <h3>Filtros</h3>
    <div class="filters">
        <select id="filterEmployee">
            <option value="">Funcionário</option>
        </select>

        <select id="filterStatus">
            <option value="">Status</option>
            <option value="Pendente">Pendente</option>
            <option value="Em andamento">Em andamento</option>
            <option value="Concluído">Concluído</option>
            <option value="Atrasado">Atrasado</option>
        </select>

        <select id="filterPeriod">
            <option value="">Período</option>
            <option value="Semana">Semana</option>
            <option value="Mês">Mês</option>
        </select>
    </div>

    <!-- TABELAS -->
    <h3>Controle de Tarefas</h3>
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
                <th>Progresso</th>
            </tr>
        </thead>
        <tbody>
@foreach($tarefas as $tarefa)
<tr>
    <td>{{ $tarefa->funcionario }}</td>
    <td>{{ $tarefa->cliente }}</td>
    <td>{{ $tarefa->tipo }}</td>
    <td>{{ $tarefa->prioridade }}</td>
    <td>{{ $tarefa->inicio }}</td>
    <td>{{ $tarefa->prazo }}</td>
    <td>{{ $tarefa->status }}</td>
    <td>-</td>
</tr>
@endforeach
</tbody>
    </table>

    <h3 style="margin-top:30px;">Controle por Cliente</h3>
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Tarefas</th>
                <th>Responsável</th>
                <th>Status Geral</th>
            </tr>
        </thead>
<tbody>
@foreach($tarefas->groupBy('cliente') as $cliente => $grupo)
<tr>
    <td>{{ $cliente }}</td>
    <td>{{ $grupo->count() }}</td>
    <td>{{ $grupo->pluck('funcionario')->unique()->join(', ') }}</td>
    <td>{{ $grupo->pluck('status')->unique()->join(', ') }}</td>
</tr>
@endforeach
</tbody>
    </table>

    <!-- GRÁFICOS -->
    <div class="grid">
        <div class="card">
            <h3>Gráfico de Tarefas por Status</h3>
            <canvas id="statusChart"></canvas>
        </div>

        <div class="card">
            <h3>Produtividade por Funcionário</h3>
            <canvas id="teamChart"></canvas>
        </div>
    </div>

    <!-- ALERTAS -->
    <div class="alert">
        <h3>Alertas Automáticos</h3>
        <ul id="alertsList"></ul>
    </div>

</div>

</body>
</html>