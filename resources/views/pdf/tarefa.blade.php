<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tarefa</title>

<style>

body{
font-family: Arial;
}

.box{
border:1px solid #ddd;
padding:20px;
}

h2{
margin-bottom:20px;
}

p{
margin:8px 0;
}

</style>

</head>
<body>

<h2>Detalhes da Tarefa</h2>

<div class="box">

<p><strong>Funcionário:</strong> {{ $tarefa->funcionario }}</p>

<p><strong>Cliente:</strong> {{ $tarefa->cliente }}</p>

<p><strong>Tipo:</strong> {{ $tarefa->tipo }}</p>

<p><strong>Prioridade:</strong> {{ $tarefa->prioridade }}</p>

<p><strong>Início:</strong> {{ $tarefa->inicio }}</p>

<p><strong>Prazo:</strong> {{ $tarefa->prazo }}</p>

<p><strong>Status:</strong> {{ $tarefa->status }}</p>

</div>

</body>
</html>