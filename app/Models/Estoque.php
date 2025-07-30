<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque';
    protected $primaryKey = 'id_item_estoque';
    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'quantidade',
        'estoque_min',
    ];

    public function movimentacoesGerais(): HasMany
    {
        return $this->hasMany(MovimentacaoGeralEstoque::class, 'id_item_estoque', 'id_item_estoque');
    }

    public function usosEmConsulta(): HasMany
    {
        return $this->hasMany(UsoMateriaisConsulta::class, 'id_item_estoque', 'id_item_estoque');
    }
}