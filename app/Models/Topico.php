<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    use HasFactory;

    protected $table = 'topicos';
    protected $fillable = [
        'nome',
        'palavras_chave',
        'resumo',
        'link_site',
        'link_premium'
    ];
}