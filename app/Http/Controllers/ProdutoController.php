<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $produtos = Produto::where('nome', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%") 
                ->orWhere('marca', 'LIKE', "%{$search}%")  
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
        $venda = Venda::findOrFail($vendaId);

        $request->validate([
            'produto_ids' => 'required|array',
            'produto_ids.*' => 'exists:produtos,id',
        ]);

        foreach ($request->produto_ids as $produtoId) {
            $produto = Produto::find($produtoId);
            $venda->produtos()->attach($produto);
        }

        return redirect()->route('vendas.show', $venda->id);
    }
}
