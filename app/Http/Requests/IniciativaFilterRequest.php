<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IniciativaFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => 'nullable|string|in:água,ecologia,saneamento,energia,conservação',
            'status' => 'nullable|string|in:em_andamento,concluído,planejado',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'q' => 'nullable|string',
        ];
    }
}
