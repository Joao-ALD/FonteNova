<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iniciativa; // Verifique se o model foi importado

class HomeController extends Controller
{
    public function index()
    {
        $iniciativas = Iniciativa::all();

        $dadosIniciativasParaMapa = [];
        foreach ($iniciativas as $iniciativa) {
            $dadosIniciativasParaMapa[$iniciativa->estado_sigla] = [
                'titulo' => $iniciativa->titulo,
                'descricao' => $iniciativa->descricao,
            ];
        }

        return view('home', [
            'dadosIniciativasJson' => json_encode($dadosIniciativasParaMapa)
        ]);
    }
}
