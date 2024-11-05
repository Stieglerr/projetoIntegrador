<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendasController;



Route::get('/', function () {
    return view('home');
});

Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::resource('clientes', ClienteController::class);
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::resource('produtos', ProdutoController::class);
Route::resource('vendas', VendasController::class);

