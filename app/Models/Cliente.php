<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente'; // Nome correto da tabela

    protected $fillable = ['nome', 'cpf', 'telefone', 'email', 'endereco'];

    public function vendas()
    {
        return $this->hasMany(Venda::class);    
    }
}
