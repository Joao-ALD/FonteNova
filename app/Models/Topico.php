<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model: Topico
 *
 * Representa um tópico de conteúdo relacionado à água. Utilizado pelo ChatBot
 * para buscar correspondência por palavras-chave. Campos principais:
 * - nome: título do tópico
 * - palavras_chave: CSV com palavras para matching
 * - resumo: texto de resposta rápida
 * - link_site / link_premium: URLs para conteúdo adicional
 */
class Topico extends Model
{
    use HasFactory;

    protected $table = 'topicos';
    protected $fillable = [
        'titulo',
        'palavras_chave',
        'resumo',
        'link_site',
        'link_premium'
    ];
}