<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    // Adicione isto:
    protected $fillable = [
        'titulo',
        'descricao_html',
        'video_embed_url',
        'ordem',
    ];
}