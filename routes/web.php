<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendasController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas de clientes
Route::resource('clientes', ClienteController::class);
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

// Rotas de produtos
Route::resource('produtos', ProdutoController::class);

// Rotas de vendas
Route::resource('vendas', VendasController::class);
Route::post('/vendas/{vendaId}/produtos', [ProdutoController::class, 'addToVenda'])->name('produtos.addToVenda');
Route::get('vendas/{id}', [VendasController::class, 'show'])->name('vendas.show');
