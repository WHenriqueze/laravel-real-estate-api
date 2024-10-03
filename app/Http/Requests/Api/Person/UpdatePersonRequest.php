<?php

namespace App\Http\Requests\Api\Person;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:500',
            'email' => 'required|email|max:350',
            'telefono' => 'required|string|max:50',
        ];
    }
}
