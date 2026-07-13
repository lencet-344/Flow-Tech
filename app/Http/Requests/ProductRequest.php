<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'type' => 'required|string|max:30',
            'quantity' => 'required|integer',
            'cost' => 'required|numeric',
            'presentation' => 'required|string|max:50',
            'state' => 'required|string|max:30',
            'code_bar' => 'required|string|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es requerido',
            'name.max' => 'El nombre no debe exceder los 30 caracteres',
            'type.required' => 'El tipo de producto es requerido',
            'type.max' => 'El tipo no debe exceder los 30 caracteres',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'cost.required' => 'El costo es requerido',
            'cost.numeric' => 'El costo debe ser numérico',
            'presentation.required' => 'La presentación es requerida',
            'presentation.max' => 'La presentación no debe exceder los 50 caracteres',
            'state.required' => 'El estado es requerido',
            'state.max' => 'El estado no debe exceder los 30 caracteres',
            'code_bar.required' => 'El código de barras es requerido',
            'code_bar.max' => 'El código de barras no debe exceder los 30 caracteres',
        ];
    }
}