<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantidadeToProdutoVendaTable extends Migration
{
    public function up()
    {
        Schema::table('produto_venda', function (Blueprint $table) {
            $table->integer('quantidade')->default(1); // Adicionando a coluna 'quantidade'
        });
    }

    public function down()
    {
        Schema::table('produto_venda', function (Blueprint $table) {
            $table->dropColumn('quantidade');
        });
    }
}
