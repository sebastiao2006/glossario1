<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Tarefas</title>

<style>

body{
font-family:Arial;
margin:0;
background:#f4f6f9;
}

.container{
width:90%;
margin:auto;
margin-top:30px;
}

form{
background:white;
padding:20px;
border-radius:8px;
margin-bottom:30px;
}

input,select,textarea{
width:100%;
padding:10px;
margin-top:10px;
margin-bottom:15px;
border:1px solid #ddd;
border-radius:5px;
}

button{
background:#feae1b;
color:white;
border:none;
padding:10px 20px;
border-radius:5px;
cursor:pointer;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

th,td{
padding:12px;
border:1px solid #ddd;
}

th{
background:#feae1b;
color:white;
}

</style>

</head>
<body>

@include('header')

<div class="container">

<h2>Cadastrar Tarefa</h2>

<form>

<input type="text" placeholder="Título da tarefa">

<textarea placeholder="Descrição da tarefa"></textarea>

<select>
<option>Funcionário responsável</option>
<option>Maria</option>
<option>João</option>
</select>

<input type="date">

<button type="submit">Criar Tarefa</button>

</form>


<h2>Lista de Tarefas</h2>

<table>

<tr>
<th>ID</th>
<th>Tarefa</th>
<th>Funcionário</th>
<th>Data</th>
<th>Status</th>
</tr>

<tr>
<td>1</td>
<td>Declarar imposto</td>
<td>Maria</td>
<td>10/03/2026</td>
<td>Pendente</td>
</tr>

</table>

</div>

</body>
</html>
