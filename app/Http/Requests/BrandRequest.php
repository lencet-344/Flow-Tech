<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'country_origin' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la marca es requerido',
            'country_origin.required' => 'El país de origen es requerido',
            'industry.required' => 'La industria es requerida',
            'description.max' => 'La descripción no debe exceder los 500 caracteres',
        ];
    }
}