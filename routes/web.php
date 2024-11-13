<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('clientes', ClienteController::class);
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::resource('produtos', ProdutoController::class);

Route::resource('vendas', VendasController::class);
Route::post('/vendas/{vendaId}/produtos', [ProdutoController::class, 'addToVenda'])->name('produtos.addToVenda');
Route::get('vendas/{id}', [VendasController::class, 'show'])->name('vendas.show');


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
