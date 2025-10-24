<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model: Quizz
 *
 * Representa itens do quizz. Atualmente usado no front-end para estrutura
 * de perguntas e respostas (ver resources/views/quizz.blade.php).
 */
class Quizz extends Model
{
    use HasFactory;
}
