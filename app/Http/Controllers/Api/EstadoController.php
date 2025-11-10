<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Http\Resources\EstadoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Cache::remember('estados_list', 60, function () {
            return Estado::all();
        });
        return EstadoResource::collection($estados);
    }

    public function show($uf)
    {
        $estado = Estado::where('sigla', $uf)->firstOrFail();
        return new EstadoResource($estado);
    }
}
