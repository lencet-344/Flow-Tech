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
            'name' => 'required|string|max:30',
            'logo' => 'nullable|string|max:100',
            'country_origin' => 'required|string|max:100',
            'industry' => 'required|string|max:30',
            'description' => 'required|string|max:100',
            'product_id' => 'required|integer|exists:products,id',
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
            'product_id.required' => 'El campo producto es requerido',
            'product_id.integer' => 'El campo producto debe ser un número entero',
            'product_id.exists' => 'La referencia seleccionada en producto no existe',
        ];
    }
}