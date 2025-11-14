<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EstadoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sigla' => $this->sigla,
            'nome' => $this->nome,
            'regiao' => $this->regiao,
            'dados_geograficos' => $this->dados_geograficos,
            'iniciativas_count' => $this->iniciativas()->count(),
        ];
    }
}