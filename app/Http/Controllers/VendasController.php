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
    $vendas = Venda::with('produtos')->get(); // Carrega as vendas com os produtos relacionados
    
    // Calcula o valor total de cada venda
    foreach ($vendas as $venda) {
        $venda->valor_total = $venda->produtos->sum(function($produto) {
            // Acessa o preço do produto diretamente na tabela `produto`
            return $produto->preco * $produto->pivot->quantidade;
        });
    }

    return view('vendas.index', compact('vendas'));
}



    public function create()
    {
        // Carrega todos os clientes e produtos disponíveis
        $clientes = Cliente::all();
        $produtos = Produto::all();

        // Retorna a view de criação de vendas
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
{
    // Valida os dados de entrada
    $request->validate([
        'cliente_id' => 'required|exists:cliente,id',
        'produto_id' => 'required|array',
        'produto_id.*' => 'exists:produto,id',
        'quantidade' => 'required|array',
        'quantidade.*' => 'integer|min:1'
    ]);

    // Cria uma nova venda
    $venda = Venda::create(['cliente_id' => $request->cliente_id]);

    $valorTotal = 0;

    // Itera sobre os produtos e suas respectivas quantidades
    foreach ($request->produto_id as $index => $produtoId) {
        // Obtém o produto selecionado
        $produto = Produto::findOrFail($produtoId);
        $quantidade = $request->quantidade[$index];

        // Verifica se há estoque suficiente
        if ($produto->quantidade < $quantidade) {
            return redirect()->back()->withErrors(['msg' => 'Quantidade insuficiente para o produto ' . $produto->nome]);
        }

        // Atualiza o estoque do produto
        $produto->quantidade -= $quantidade;
        $produto->save();

        // Calcula o valor total da venda
        $valorTotal += $produto->preco * $quantidade;

        // Associa o produto à venda, incluindo a quantidade
        $venda->produtos()->attach($produtoId, ['quantidade' => $quantidade]);
    }

    // Salva o valor total da venda
    $venda->valor_total = $valorTotal;
    $venda->save();

    // Redireciona para a lista de vendas com uma mensagem de sucesso
    return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
}

    public function update(Request $request, $id)
    {
        // Encontra a venda a ser atualizada
        $venda = Venda::findOrFail($id);
        $venda->cliente_id = $request->cliente_id;

        // Recalcula o valor total considerando a quantidade de cada produto
        $valorTotal = 0;
        foreach ($venda->produtos as $produto) {
            $quantidade = $produto->pivot->quantidade; // Quantidade armazenada na tabela pivô
            $valorTotal += $produto->preco * $quantidade;
        }

        // Atualiza o valor total da venda
        $venda->valor_total = $valorTotal;
        $venda->save();

        // Redireciona para a lista de vendas com uma mensagem de sucesso
        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }
    public function show($id)
{
    // Encontra a venda com seus produtos
    $venda = Venda::with(['produtos'])->findOrFail($id);

    // Adiciona o preço total dos produtos multiplicado pela quantidade
    foreach ($venda->produtos as $produto) {
        // Calcula o preço total considerando a quantidade
        $produto->total = $produto->preco * $produto->pivot->quantidade;
    }

    return view('vendas.show', compact('venda'));
}

}
