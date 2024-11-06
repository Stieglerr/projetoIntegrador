<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProdutoIdFromVendasTable extends Migration
{
    public function up()
    {
        Schema::table('vendas', function (Blueprint $table) {
            // Primeiro, remova a chave estrangeira
            $table->dropForeign(['produto_id']);
            // Agora, remova a coluna `produto_id`
            $table->dropColumn('produto_id');
        });
    }

    public function down()
    {
        Schema::table('vendas', function (Blueprint $table) {
            // Recria a coluna `produto_id` e a chave estrangeira
            $table->foreignId('produto_id')->constrained('produto');
        });
    }
}
