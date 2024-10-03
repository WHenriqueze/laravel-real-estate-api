<?php

namespace App\Http\Requests\Api\Visit;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'persona_id' => 'required|exists:people,id',
            'propiedad_id' => 'required|exists:properties,id',
            'fecha_visita' => 'required|date',
            'comentarios' => 'nullable|string',
        ];
    }
}
