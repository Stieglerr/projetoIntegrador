<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ProdutoVenda extends Model
{
    protected $table = 'produto_venda';

    // Definir os campos que podem ser preenchidos
    protected $fillable = ['produto_id', 'venda_id', 'quantidade'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
