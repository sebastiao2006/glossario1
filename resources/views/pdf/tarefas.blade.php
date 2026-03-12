<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lista de Tarefas</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header img {
    width: 120px; /* Ajuste o tamanho do logo */
    margin-bottom: 10px;
}

h2 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    font-size: 12px;
}

th {
    background-color: #f4f4f4;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Barra dourada */
.footer-bar {
    height: 5px;
    background-color: #feae1b; /* dourado */
    margin-top: 30px;
}

/* Rodapé da empresa */
.footer {
    text-align: center;
    font-size: 12px;
    color: #555;
    margin-top: 5px;
}
</style>

</head>
<body>

<div class="header">
    <img src="{{ public_path('images/logo.jpg') }}" alt="Logo da Empresa">
    <h2>Lista de Todas as Tarefas</h2>
</div>

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

<div class="footer-bar"></div>

<div class="footer">
    Empresa XYZ - Rua Exemplo, Nº 123 - Luanda, Angola <br>
    Telefone: +244 123 456 789 | Email: contato@empresa.xyz
</div>

</body>
</html>