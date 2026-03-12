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
        table form{
        display:inline;
        margin:0;
        padding:0;
        background:none;
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
        background:#e74c3c;
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

<form action="/funcionarios" method="POST">

    @csrf

    <input type="text" name="nome" placeholder="Nome" required>

    <input type="email" name="email" placeholder="Email">

    <input type="text" name="telefone" placeholder="Telefone">

    <select name="cargo">
    <option value="">Cargo</option>
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
        <th>Ação</th>
        </tr>

        @foreach($funcionarios as $funcionario)

        <tr>
        <td>{{ $funcionario->id }}</td>
        <td>{{ $funcionario->nome }}</td>
        <td>{{ $funcionario->email }}</td>
        <td>{{ $funcionario->telefone }}</td>
        <td>{{ $funcionario->cargo }}</td>

        <td>
        <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Apagar</button>
        </form>
        </td>

        </tr>

        @endforeach

</table>

</div>

</body>
</html>