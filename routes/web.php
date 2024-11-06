<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendasController;



Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::resource('clientes', ClienteController::class);
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::resource('produtos', ProdutoController::class);
Route::resource('vendas', VendasController::class);
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
Route::post('/vendas/{vendaId}/produtos', [ProdutoController::class, 'addToVenda'])->name('produtos.addToVenda');

