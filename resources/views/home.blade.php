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

<header style="color:white;padding:15px 40px;display:flex;justify-content:space-between;align-items:center;">

    <div class="header-title" style="display:flex;align-items:center;gap:15px;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:90px;">
        <h2 style="margin:0;">Dashboard de Tarefas - Empresa de Contabilidade</h2>
    </div>

    <nav>
        <ul style="display:flex;gap:25px;list-style:none;margin:0;">
            <li><a href="/" style="color:white;text-decoration:none;">Dashboard</a></li>
            <li><a href="/clientes" style="color:white;text-decoration:none;">Clientes</a></li>
            <li><a href="/funcionarios" style="color:white;text-decoration:none;">Funcionários</a></li>
            <li><a href="/tarefas" style="color:white;text-decoration:none;">Tarefas</a></li>
        </ul>
    </nav>

</header>

<div class="container">

    <!-- BOTÃO -->
    {{-- <button id="showFormBtn">+ Adicionar Tarefa</button> --}}

    <!-- MODAL -->
    <div id="taskModal" class="modal">

        <div class="modal-content">

            <span class="close">&times;</span>

            <h3>Adicionar Nova Tarefa</h3>

            <form method="POST" action="{{ route('tarefas.store') }}">
            @csrf

            <input type="text" name="funcionario" placeholder="Funcionário" required>

            <input type="text" name="cliente" placeholder="Cliente" required>

            <input type="text" name="tipo" placeholder="Tipo" required>

            <select name="prioridade">
            <option value="Alta">Alta</option>
            <option value="Média">Média</option>
            <option value="Baixa">Baixa</option>
            </select>

            <input type="date" name="inicio" min="2025-12-12" max="2026-12-12" required>

            <input type="date" name="prazo" min="2025-12-12" max="2026-12-12" required>

            <select name="status">
            <option value="Pendente">Pendente</option>
            <option value="Em andamento">Em andamento</option>
            <option value="Concluído">Concluído</option>
            <option value="Atrasado">Atrasado</option>
            </select>

            <button type="submit">Adicionar Tarefa</button>

            </form>

        </div>

    </div>

        <!-- CARDS -->
        <div class="cards">

                <div class="card">
                <h3>Total de Tarefas</h3>
                <p>{{ $totalTasks }}</p>
                </div>

                <div class="card">
                <h3>Concluídas</h3>
                <p>{{ $completedTasks }}</p>
                </div>

                <div class="card">
                <h3>Em Andamento</h3>
                <p>{{ $inProgressTasks }}</p>
                </div>

                <div class="card">
                <h3>Atrasadas</h3>
                <p>{{ $overdueTasks }}</p>
                </div>

                <div class="card">
                <h3>Produtividade</h3>
                <p>{{ $productivity }}%</p>
                </div>

        </div>

        <!-- FILTROS -->
        <h3>Filtros</h3>

        <form method="GET" action="{{ route('home') }}">

                <div class="filters">

                <select name="funcionario">
                <option value="">Funcionário</option>

                @foreach($funcionarios as $func)
                <option value="{{ $func->funcionario }}">
                {{ $func->funcionario }}
                </option>
                @endforeach

                </select>


                <select name="status">
                <option value="">Status</option>
                <option value="Pendente">Pendente</option>
                <option value="Em andamento">Em andamento</option>
                <option value="Concluído">Concluído</option>
                <option value="Atrasado">Atrasado</option>
                </select>


                <select name="periodo">
                <option value="">Período</option>
                <option value="Semana">Semana</option>
                <option value="Mes">Mês</option>
                </select>

                <button type="submit">Filtrar</button>

                </div>

        </form>

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
                <td>{{ $tarefa->inicio }}</td>
                <td>{{ $tarefa->prazo }}</td>

                <!-- STATUS -->
                <td>{{ $tarefa->status }}</td>

                <!-- ALERTA -->
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

                <!-- PROGRESSO -->
                <td>

                        @if($tarefa->status == "Concluído")

                        <div class="progress-bar">
                        <div class="progress" style="width:100%"></div>
                        </div>

                        @elseif($tarefa->status == "Em andamento")

                        <div class="progress-bar">
                        <div class="progress yellow" style="width:50%"></div>
                        </div>

                        @else

                        <div class="progress-bar">
                        <div class="progress red" style="width:10%"></div>
                        </div>

                        @endif

                </td>

                <!-- AÇÕES -->
                <td>

                    <form action="{{ route('tarefas.concluir',$tarefa->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn-concluir">Concluir</button>
                    </form>

                    <a href="{{ route('tarefas.edit',$tarefa->id) }}" class="btn-editar">Editar</a>

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

                    @foreach($clientes as $cliente)

                    <tr>

                    <td>{{ $cliente->cliente }}</td>

                    <td>{{ $cliente->total }}</td>

                    <td>{{ $cliente->responsaveis }}</td>

                    <td>
                    @if($cliente->total > 0)
                    Em andamento
                    @else
                    Sem tarefas
                    @endif
                    </td>

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

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>


</html>