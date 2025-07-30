<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profissional extends Model
{
    use HasFactory;

    protected $table = 'profissionais';
    protected $primaryKey = 'id_profissional';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cro',
        'ativo',
        'data_contratacao',
        'salario_base',
    ];

    public function consultas(): HasMany
    {
        return $this->hasMany(Consulta::class, 'id_profissional', 'id_profissional');
    }

    public function especialidades(): BelongsToMany
    {
        return $this->belongsToMany(
            Especialidade::class,
            'profissional_especialidades',
            'id_profissional',
            'id_especialidade'
        );
    }
}