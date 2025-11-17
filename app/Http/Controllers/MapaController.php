<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Iniciativa;

class MapaController extends Controller
{
    public function index()
    {
        return view('mapa');
    }

    public function getEstadoInfo($estado)
    {
        $estadoModel = Estado::where('sigla', strtoupper($estado))->first();
        
        if (!$estadoModel) {
            return response()->json(['nome' => 'Estado não encontrado', 'iniciativas' => []]);
        }

        $iniciativas = $estadoModel->iniciativas()->get(['titulo', 'descricao', 'tipo', 'status', 'link_externo'])->toArray();
        
        return response()->json([
            'nome' => $estadoModel->nome,
            'iniciativas' => $iniciativas
        ]);
    }
}
