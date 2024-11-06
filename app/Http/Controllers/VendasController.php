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
        $vendas = Venda::with(['cliente', 'produtos'])->get();
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
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'produto_id' => 'required|array',
            'produto_id.*' => 'exists:produto,id',
        ]);

        // Cria a venda apenas com o cliente_id
        $venda = Venda::create(['cliente_id' => $request->cliente_id]);

        // Associa os produtos selecionados à venda na tabela produto_venda
        $venda->produtos()->attach($request->produto_id);

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }
}
