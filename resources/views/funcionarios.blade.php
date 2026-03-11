<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Funcionários</title>

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

        input,select{
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

<h2>Cadastrar Funcionário</h2>

<form>

<input type="text" placeholder="Nome">

<input type="email" placeholder="Email">

<input type="text" placeholder="Telefone">

<select>
<option>Cargo</option>
<option>Contabilista</option>
<option>Gestor</option>
<option>Assistente</option>
</select>

<button type="submit">Cadastrar</button>

</form>

<h2>Lista de Funcionários</h2>

<table>

<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Telefone</th>
<th>Cargo</th>
</tr>

<tr>
<td>1</td>
<td>Maria Santos</td>
<td>maria@email.com</td>
<td>923000000</td>
<td>Contabilista</td>
</tr>

</table>

</div>

</body>
</html>