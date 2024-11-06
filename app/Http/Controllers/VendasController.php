<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'produto'])->get();
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        Venda::create($request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'produto_id' => 'required|exists:produto,id',
        ]));

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }
}
