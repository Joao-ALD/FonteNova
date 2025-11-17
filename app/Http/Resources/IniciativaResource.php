<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IniciativaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'tipo' => $this->tipo,
            'status' => $this->status,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'impacto_estimado' => $this->impacto_estimado,
            'investimento' => $this->investimento,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'estado' => [
                'sigla' => $this->estado->sigla,
                'nome' => $this->estado->nome,
            ],
        ];
    }
}