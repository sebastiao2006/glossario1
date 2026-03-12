<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Detalhes da Tarefa</title>
<style>
body {
    font-family: Arial, sans-serif;
    text-align: center;
}

h3 {
    margin-top: 20px;
}

table {
    width: 100%; /* tabela ocupa toda a largura */
    margin: 20px auto;
    border-collapse: collapse;
    table-layout: fixed; /* garante largura uniforme das colunas */
}

th, td {
    border: 1px solid #ddd;
    padding: 12px; /* aumenta o espaçamento */
    text-align: left;
    word-wrap: break-word; /* quebra texto grande */
}

th {
    background-color: #faad14;
}
</style>
</head>
<body>

<h3>Detalhes da Tarefa</h3>

<table>
    <thead>
        <tr>
            <th>Funcionário</th>
            <th>Cliente</th>
            <th>Tarefa</th>
            <th>Prioridade</th>
            <th>Início</th>
            <th>Prazo de Entrega</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $tarefa->funcionario }}</td>
            <td>{{ $tarefa->cliente }}</td>
            <td>{{ $tarefa->tipo }}</td>
            <td>{{ $tarefa->prioridade }}</td>
            <td>{{ $tarefa->inicio }}</td>
            <td>{{ $tarefa->prazo }}</td>
            <td>{{ $tarefa->status }}</td>
        </tr>
    </tbody>
</table>

</body>
</html>