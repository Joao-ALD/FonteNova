<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Iniciativa;
use App\Http\Resources\IniciativaResource;
use App\Http\Requests\IniciativaFilterRequest;
use App\Models\Estado;

class IniciativaController extends Controller
{
    public function index(IniciativaFilterRequest $request)
    {
        $query = Iniciativa::query();

        if ($request->filled('tipo')) {
            $query->porTipo($request->tipo);
        }

        if ($request->filled('status')) {
            $query->porStatus($request->status);
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('data_inicio', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data_fim', '<=', $request->data_fim);
        }

        if ($request->filled('q')) {
            $query->where('titulo', 'like', "%{$request->q}%")
                  ->orWhere('descricao', 'like', "%{$request->q}%");
        }

        $iniciativas = $query->get();
        return IniciativaResource::collection($iniciativas);
    }

    public function porEstado(IniciativaFilterRequest $request, $uf)
    {
        $estado = Estado::where('sigla', $uf)->firstOrFail();
        $query = $estado->iniciativas();

        if ($request->filled('tipo')) {
            $query->porTipo($request->tipo);
        }

        if ($request->filled('status')) {
            $query->porStatus($request->status);
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('data_inicio', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data_fim', '<=', $request->data_fim);
        }

        $iniciativas = $query->get();
        return IniciativaResource::collection($iniciativas);
    }
}
