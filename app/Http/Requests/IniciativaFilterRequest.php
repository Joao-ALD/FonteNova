<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IniciativaFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo' => 'sometimes|in:água,ecologia,saneamento,energia,conservação',
            'status' => 'sometimes|in:em_andamento,concluído,planejado',
            'data_inicio' => 'sometimes|date',
            'data_fim' => 'sometimes|date',
            'q' => 'sometimes|string|max:255',
        ];
    }
}