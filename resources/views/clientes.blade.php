<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Clientes</title>

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

        input{
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
        text-align:left;
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

<h2>Cadastrar Cliente</h2>

<form action="/clientes" method="POST">

        @csrf

        <input type="text" name="nome" placeholder="Nome da Empresa" required>

        <input type="email" name="email" placeholder="Email">

        <input type="text" name="telefone" placeholder="Telefone">

        <input type="text" name="nif" placeholder="NIF">

        <button type="submit">Cadastrar</button>

</form>



       <h2>Lista de Clientes</h2>

<table>

        <tr>
        <th>ID</th>
        <th>Empresa</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>NIF</th>
        </tr>

        @foreach($clientes as $cliente)

        <tr>
        <td>{{ $cliente->id }}</td>
        <td>{{ $cliente->nome }}</td>
        <td>{{ $cliente->email }}</td>
        <td>{{ $cliente->telefone }}</td>
        <td>{{ $cliente->nif }}</td>
        </tr>

        @endforeach

</table>

</div>

</body>
</html>