<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';
    protected $fillable = ['cliente_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    
        public function produtos()
        {
            return $this->belongsToMany(Produto::class, 'produto_venda', 'venda_id', 'produto_id')
                ->withPivot('quantidade', );
        }
    
}
