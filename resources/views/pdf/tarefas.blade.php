<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lista de Tarefas</title>

<style>
body{
font-family: Arial;
}

table{
width:100%;
border-collapse: collapse;
}

th,td{
border:1px solid #ddd;
padding:8px;
text-align:left;
}

th{
background:#f4f4f4;
}
</style>

</head>
<body>

<h2>Lista de Todas as Tarefas</h2>

<table>
<tr>
<th>Funcionário</th>
<th>Cliente</th>
<th>Tipo</th>
<th>Prioridade</th>
<th>Início</th>
<th>Prazo</th>
<th>Status</th>
</tr>

@foreach($tarefas as $tarefa)
<tr>
<td>{{ $tarefa->funcionario }}</td>
<td>{{ $tarefa->cliente }}</td>
<td>{{ $tarefa->tipo }}</td>
<td>{{ $tarefa->prioridade }}</td>
<td>{{ $tarefa->inicio }}</td>
<td>{{ $tarefa->prazo }}</td>
<td>{{ $tarefa->status }}</td>
</tr>
@endforeach

</table>

</body>
</html>