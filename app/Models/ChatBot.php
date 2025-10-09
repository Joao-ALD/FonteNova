<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBot extends Model
{
    use HasFactory;

    /**
     * Campos atribuíveis em massa. Mesmo que o ChatBot atualmente não persista
     * muitas informações, manter o $fillable evita problemas de MassAssignment no futuro.
     * Ajuste conforme o schema real do banco quando necessário.
     *
     * @var array
     */
    protected $fillable = [
        'pergunta',
        'resposta',
        'topico_id'
    ];
}
