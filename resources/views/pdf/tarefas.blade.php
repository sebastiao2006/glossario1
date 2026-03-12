<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Controle de Tarefas</title>
<style>
body { font-family: Arial, sans-serif; text-align: center; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
th { background: #faad14; }
</style>
</head>
<body>
<h3>Controle de Tarefas</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Funcionário</th>
            <th>Cliente</th>
            <th>Tipo</th>
            <th>Prioridade</th>
            <th>Início</th>
            <th>Prazo</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tarefas as $tarefa)
        <tr>
            <td>{{ $tarefa->id }}</td>
            <td>{{ $tarefa->funcionario }}</td>
            <td>{{ $tarefa->cliente }}</td>
            <td>{{ $tarefa->tipo }}</td>
            <td>{{ $tarefa->prioridade }}</td>
            <td>{{ $tarefa->inicio }}</td>
            <td>{{ $tarefa->prazo }}</td>
            <td>{{ $tarefa->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>