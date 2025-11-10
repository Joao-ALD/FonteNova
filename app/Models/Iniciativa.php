<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iniciativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado_id',
        'titulo',
        'descricao',
        'tipo',
        'status',
        'data_inicio',
        'data_fim',
        'impacto_estimado',
        'investimento',
        'latitude',
        'longitude',
        'imagens',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function scopePorStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
