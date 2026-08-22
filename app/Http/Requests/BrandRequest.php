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
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es requerido',
            'name.max' => 'El campo nombre no debe exceder los 30 caracteres',
            'logo.nullable' => 'El campo logo es opcional',
            'logo.max' => 'El campo logo no debe exceder los 100 caracteres',
            'country_origin.required' => 'El campo país de origen es requerido',
            'country_origin.max' => 'El campo país de origen no debe exceder los 100 caracteres',
            'industry.required' => 'El campo industria es requerido',
            'industry.max' => 'El campo industria no debe exceder los 30 caracteres',
            'description.required' => 'El campo descripcion es requerido',
            'description.max' => 'El campo descripcion no debe exceder los 100 caracteres',
            'category_id.required' => 'El campo categoría es requerido',
            'category_id.exists' => 'La categoría seleccionada no es válida',
        ];
    }
}