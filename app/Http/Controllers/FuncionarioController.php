<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{

    public function index()
    {
        $funcionarios = Funcionario::all();

        return view('funcionarios', compact('funcionarios'));
    }

    public function store(Request $request)
    {
        Funcionario::create($request->all());

        return redirect('/funcionarios');
    }
    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return redirect()->back();
    }

}