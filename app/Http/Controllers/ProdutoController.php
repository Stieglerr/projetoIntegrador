<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        // Obtém o termo de pesquisa, se existir
        $search = $request->input('search');

        // Filtra os produtos com base no termo de pesquisa
        if ($search) {
            $produtos = Produto::where('nome', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%")  // Busca pelo ID
                ->orWhere('marca', 'LIKE', "%{$search}%")  // Busca pela Marca
                ->get();
        } else {
            $produtos = Produto::all();
        }

        return view('produtos.index', compact('produtos', 'search'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados antes de criar o produto
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'marca' => 'required|string|max:255',
        ]);

        Produto::create($request->all());
        return redirect()->route('produtos.index');
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        // Validação dos dados antes de atualizar o produto
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'marca' => 'required|string|max:255',
        ]);

        $produto->update($request->all());
        return redirect()->route('produtos.index');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index');
    }

    public function addToVenda(Request $request, $vendaId)
    {
        // Recupera a venda existente
        $venda = Venda::findOrFail($vendaId);

        // Validação dos produtos selecionados
        $request->validate([
            'produto_ids' => 'required|array',
            'produto_ids.*' => 'exists:produtos,id', // Valida se o produto existe
        ]);

        // Adiciona os produtos à venda
        foreach ($request->produto_ids as $produtoId) {
            $produto = Produto::find($produtoId);
            // Associar o produto à venda (supondo uma tabela pivot produto_venda)
            $venda->produtos()->attach($produto);
        }

        return redirect()->route('vendas.show', $venda->id);
    }
}
