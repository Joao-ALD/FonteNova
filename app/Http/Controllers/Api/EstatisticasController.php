<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\Iniciativa;
use Illuminate\Support\Facades\DB;

class EstatisticasController extends Controller
{
    public function index()
    {
        $estatisticas = [
            'total_iniciativas' => Iniciativa::count(),
            'investimento_total' => Iniciativa::sum('investimento'),
            'por_regiao' => Estado::select('regiao', DB::raw('count(iniciativas.id) as total'))
                ->leftJoin('iniciativas', 'estados.id', '=', 'iniciativas.estado_id')
                ->groupBy('regiao')
                ->get(),
            'por_tipo' => Iniciativa::select('tipo', DB::raw('count(*) as total'))
                ->groupBy('tipo')
                ->get(),
            'por_status' => Iniciativa::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get(),
        ];

        return response()->json($estatisticas);
    }
}