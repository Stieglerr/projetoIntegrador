<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produto';
    protected $fillable = ['nome', 'preco', 'quantidade', 'marca'];

        public function vendas()
        {
            return $this->belongsToMany(Venda::class, 'produto_venda', 'produto_id', 'venda_id')
                        ->withPivot('quantidade', 'preco');
        }
            
}
