<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iniciativa;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial e passa os dados para o mapa interativo.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Busca todas as iniciativas cadastradas no banco de dados.
        $iniciativas = Iniciativa::all();

        $dadosIniciativasParaMapa = [];
        foreach ($iniciativas as $iniciativa) {
            // Formata os dados para o mapa, usando a sigla do estado como chave.
            $dadosIniciativasParaMapa[$iniciativa->estado_sigla] = [
                'titulo' => $iniciativa->titulo,
                'descricao' => $iniciativa->descricao,
            ];
        }

        // Converte o array para JSON e o passa para a view.
        $dadosIniciativasJson = json_encode($dadosIniciativasParaMapa);

        return view('home', compact('dadosIniciativasJson'));
    }
}
