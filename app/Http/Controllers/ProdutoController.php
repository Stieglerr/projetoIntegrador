<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        // Obtém o termo de pesquisa, se existir
        $search = $request->input('search');

        // Filtra os produtos com base no termo de pesquisa
        $produtos = $search
            ? Produto::where('nome', 'LIKE', "%{$search}%")->get()
            : Produto::all();

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
}
