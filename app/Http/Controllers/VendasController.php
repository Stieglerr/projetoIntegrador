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
        $vendas = Venda::with('produtos')->get();

        foreach ($vendas as $venda) {
            $venda->valor_total = $venda->produtos->sum(function($produto) {
                return $produto->preco * $produto->pivot->quantidade;
            });
        }

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
            'quantidade' => 'required|array',
            'quantidade.*' => 'integer|min:1'
        ]);

        $venda = Venda::create(['cliente_id' => $request->cliente_id]);

        $valorTotal = 0;

        foreach ($request->produto_id as $index => $produtoId) {
            $produto = Produto::findOrFail($produtoId);
            $quantidade = $request->quantidade[$index];

            if ($produto->quantidade < $quantidade) {
                return redirect()->back()->withErrors(['msg' => 'Quantidade insuficiente para o produto ' . $produto->nome]);
            }

            $produto->quantidade -= $quantidade;
            $produto->save();

            $valorTotal += $produto->preco * $quantidade;
            $venda->produtos()->attach($produtoId, ['quantidade' => $quantidade]);
        }

        $venda->valor_total = $valorTotal;
        $venda->save();

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $venda = Venda::findOrFail($id);
        $venda->cliente_id = $request->cliente_id;

        $valorTotal = 0;
        foreach ($venda->produtos as $produto) {
            $quantidade = $produto->pivot->quantidade;
            $valorTotal += $produto->preco * $quantidade;
        }

        $venda->valor_total = $valorTotal;
        $venda->save();

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function show($id)
    {
        $venda = Venda::with(['produtos'])->findOrFail($id);

        foreach ($venda->produtos as $produto) {
            $produto->total = $produto->preco * $produto->pivot->quantidade;
        }

        return view('vendas.show', compact('venda'));
    }
}
