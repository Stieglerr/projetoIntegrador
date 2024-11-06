<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    // Método para listar todos os clientes
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // Método para exibir o formulário de criação de cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Método para salvar um novo cliente
    public function store(Request $request)
    {
        Cliente::create($request->only(['nome', 'cpf', 'telefone', 'endereco']));
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }
}
