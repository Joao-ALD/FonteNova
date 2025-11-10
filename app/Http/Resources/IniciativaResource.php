<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IniciativaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'estado' => new EstadoResource($this->whenLoaded('estado')),
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
            'imagens' => json_decode($this->imagens),
        ];
    }
}
