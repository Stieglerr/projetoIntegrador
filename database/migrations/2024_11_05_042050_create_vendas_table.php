<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('cliente')->onDelete('cascade');
            $table->foreignId('produto_id')->constrained('produto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
