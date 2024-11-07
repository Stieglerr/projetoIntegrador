<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoVendaTable extends Migration
{
    public function up()
{
    Schema::create('produto_venda', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produto_id')->constrained('produto')->onDelete('cascade');
        $table->foreignId('venda_id')->constrained('vendas')->onDelete('cascade');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('produto_venda');
    }
}
