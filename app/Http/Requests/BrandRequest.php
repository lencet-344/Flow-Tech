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
            'logo' => 'required|string|max:100',
            'country_origin' => 'required|string|max:30',
            'industry' => 'required|string|max:30',
            'description' => 'required|string|max:100',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido',
            'name.max' => 'El campo name no debe exceder los 30 caracteres',
            'logo.required' => 'El campo logo es requerido',
            'logo.max' => 'El campo logo no debe exceder los 100 caracteres',
            'country_origin.required' => 'El campo country origin es requerido',
            'country_origin.max' => 'El campo country origin no debe exceder los 30 caracteres',
            'industry.required' => 'El campo industry es requerido',
            'industry.max' => 'El campo industry no debe exceder los 30 caracteres',
            'description.required' => 'El campo description es requerido',
            'description.max' => 'El campo description no debe exceder los 100 caracteres',
            'product_id.required' => 'El campo product id es requerido',
            'product_id.integer' => 'El campo product id debe ser un número entero',
            'product_id.exists' => 'La referencia seleccionada en product id no existe',
        ];
    }
}