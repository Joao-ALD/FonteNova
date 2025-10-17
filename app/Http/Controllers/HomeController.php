<?php

namespace App\Http\Controllers;

use App\Models\Iniciativa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index()
    {
        // 1. Busca todas as iniciativas do banco de dados
        $iniciativas = Iniciativa::all();

        // 2. Formata os dados para o JavaScript
        $dadosIniciativasParaMapa = [];
        foreach ($iniciativas as $iniciativa) {
            $dadosIniciativasParaMapa[$iniciativa->estado_sigla] = [
                'titulo' => $iniciativa->titulo,
                'descricao' => $iniciativa->descricao,
            ];
        }

        // 3. Envia os dados para a view da home, junto com outras variáveis que você possa ter
        return view('home', [ // ou o nome da sua view principal: welcome, index, etc.
            'dadosIniciativasJson' => json_encode($dadosIniciativasParaMapa)
        ]);
    }
}
