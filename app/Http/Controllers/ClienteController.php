<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes', compact('clientes'));
    }

    public function store(Request $request)
    {
        Cliente::create($request->all());

        return redirect('/clientes');
    }
}