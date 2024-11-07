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
        // Carrega todas as vendas com o relacionamento com produtos e cliente
        $vendas = Venda::with(['cliente', 'produtos'])->get();

        // Calcular o valor total de cada venda
        foreach ($vendas as $venda) {
            // Soma dos preços dos produtos para cada venda
            $venda->valor_total = $venda->produtos->sum('preco');
            // Salva o valor total atualizado no banco de dados
            $venda->save();
        }

        // Calcula a soma total de todas as vendas
        $somaTotal = $vendas->sum('valor_total');

        // Retorna a view com as vendas e o total
        return view('vendas.index', compact('vendas', 'somaTotal'));
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
        foreach ($request->produto_id as $produtoId) {
            // Obtém o produto selecionado
            $produto = Produto::findOrFail($produtoId);
            $quantidade = $request->quantidade[$produtoId] ?? 1;

            // Verifica se há estoque suficiente
            if ($produto->quantidade < $quantidade) {
                return redirect()->back()->withErrors(['msg' => 'Quantidade insuficiente para o produto ' . $produto->nome]);
            }

            // Calcula o valor total da venda
            $valorTotal += $produto->preco * $quantidade;

            // Atualiza o estoque do produto
            $produto->quantidade -= $quantidade;
            $produto->save();

            // Associa o produto à venda
            $venda->produtos()->attach($produtoId, ['quantidade' => $quantidade]);
        }

        // Salva o valor total da venda
        $venda->valor_total = $valorTotal;
        $venda->save();

        // Redireciona para a lista de vendas com uma mensagem de sucesso
        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }

    public function show($id)
    {
        // Carrega a venda com os produtos e o cliente associado
        $venda = Venda::with(['cliente', 'produtos'])->findOrFail($id);

        // Retorna a view de detalhes da venda
        return view('vendas.show', compact('venda'));
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
}
