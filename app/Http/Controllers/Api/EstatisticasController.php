<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Iniciativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstatisticasController extends Controller
{
    public function index()
    {
        $totalPorRegiao = DB::table('iniciativas')
            ->join('estados', 'iniciativas.estado_id', '=', 'estados.id')
            ->select('estados.regiao', DB::raw('count(*) as total'))
            ->groupBy('estados.regiao')
            ->get();

        $investimentoTotal = Iniciativa::sum('investimento');

        $distribuicaoPorTipo = Iniciativa::select('tipo', DB::raw('count(*) as total'))
            ->groupBy('tipo')
            ->get();

        return response()->json([
            'total_por_regiao' => $totalPorRegiao,
            'investimento_total' => $investimentoTotal,
            'distribuicao_por_tipo' => $distribuicaoPorTipo,
        ]);
    }
}
