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
@foreach($posts as $post)
    <h2>{{ $post->titulo }}</h2>
    <p>{{ $post->conteudo }}</p>
@endforeach
<header>
    <div class="header-title">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Dashboard de Tarefas - Empresa de Contabilidade</h2>
    </div>
</header>

<div class="container">

    <!-- BOTÃO PARA MOSTRAR FORMULÁRIO -->
    <button id="showFormBtn">+ Adicionar Tarefa</button>

    <!-- FORMULÁRIO DE ADICIONAR TAREFA -->
 <div id="addTaskForm">
    <h3>Adicionar Nova Tarefa</h3>

    <label for="newFunc">Funcionário</label>
    <input type="text" id="newFunc" placeholder="Nome do funcionário">

    <label for="newCliente">Cliente</label>
    <input type="text" id="newCliente" placeholder="Nome do cliente">

    <label for="newTipo">Tipo de Tarefa</label>
    <input type="text" id="newTipo" placeholder="Ex: Fechamento contábil">

    <label for="newPrioridade">Prioridade</label>
    <select id="newPrioridade">
        <option value="Alta">Alta</option>
        <option value="Média">Média</option>
        <option value="Baixa">Baixa</option>
    </select>

    <label for="newInicio">Data de Início</label>
    <input type="date" id="newInicio">

    <label for="newPrazo">Prazo</label>
    <input type="date" id="newPrazo">

    <label for="newStatus">Status</label>
    <select id="newStatus">
        <option value="Pendente">Pendente</option>
        <option value="Em andamento">Em andamento</option>
        <option value="Concluído">Concluído</option>
        <option value="Atrasado">Atrasado</option>
    </select>

    <button onclick="addTask()">Adicionar Tarefa</button>
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
        <tbody id="tasksBody"></tbody>
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
        <tbody id="clientsBody"></tbody>
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