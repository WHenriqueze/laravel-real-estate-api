<?php

namespace App\Http\Requests\Api\Property;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'direccion' => 'required|string|max:350',
            'ciudad' => 'required|string|max:350',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string',
        ];
    }
}
