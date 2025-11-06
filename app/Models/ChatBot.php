<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model for ChatBot interactions.
 *
 * This model is not currently used for persisting chat logs, but defines the
 * fillable fields that could be used for such a purpose in the future.
 */
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
