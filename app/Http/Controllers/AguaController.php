<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AguaController extends Controller
{
    public function index(){
        // Array com os tópicos e seus cards
        $topics = [
            'Clima' => [
                ['title' => 'Impacto do Clima na Água', 'text' => 'O clima desempenha um papel central na disponibilidade e na qualidade da água no planeta.'],
                ['title' => 'Clima', 'text' => 'Aqui vai a informação sobre o clima. Este é o primeiro card.']
            ],
            'Coleta' => [
                ['title' => 'Card de Coleta 1', 'text' => 'Informações sobre como a coleta da água funciona.']
            ],
            'Consumo' => [
                ['title' => 'Card de Consumo 1', 'text' => 'Dados e dicas sobre o consumo consciente da água.']
            ],
            'Preservacao' => [
                ['title' => 'Card de Preservação 1', 'text' => 'A importância de preservar nossos recursos hídricos.']
            ],
        ];

        // Passa o array para a view
        return view('agua', compact('topics'));
    }
}
