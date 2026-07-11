<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'type_product' => 'required|string|max:30',
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido',
            'name.max' => 'El campo name no debe exceder los 30 caracteres',
            'type_product.required' => 'El campo type product es requerido',
            'type_product.max' => 'El campo type product no debe exceder los 30 caracteres',
            'user_id.required' => 'El campo user id es requerido',
            'user_id.integer' => 'El campo user id debe ser un número entero',
            'user_id.exists' => 'La referencia seleccionada en user id no existe',
            'product_id.required' => 'El campo product id es requerido',
            'product_id.integer' => 'El campo product id debe ser un número entero',
            'product_id.exists' => 'La referencia seleccionada en product id no existe',
        ];
    }
}