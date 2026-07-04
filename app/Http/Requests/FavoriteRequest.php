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
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'type_product' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El usuario es requerido',
            'user_id.exists' => 'El usuario seleccionado no existe',
            'product_id.required' => 'El producto es requerido',
            'product_id.exists' => 'El producto seleccionado no existe',
            'name.required' => 'El nombre es requerido',
            'type_product.required' => 'El tipo de producto es requerido',
        ];
    }
}