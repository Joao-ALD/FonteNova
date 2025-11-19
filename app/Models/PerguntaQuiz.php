<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerguntaQuiz extends Model
{
    use HasFactory;
    
    // Nome da tabela (Laravel usa o plural, mas é bom ser explícito)
    protected $table = 'pergunta_quiz'; 

    protected $fillable = [
        'pergunta',
        'opcao_a',
        'opcao_b',
        'opcao_c',
        'resposta_correta',
        'litros_economizados',
        'ordem',
    ];

    public function getJsonDataAttribute()
    {
        return [
            'question' => $this->pergunta,
            'a' => $this->opcao_a,
            'b' => $this->opcao_b,
            'c' => $this->opcao_c,
            'correct' => $this->resposta_correta,
            'liters' => $this->litros_economizados,
        ];
    }
}