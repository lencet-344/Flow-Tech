<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'type' => 'required|string|max:20',
            'quantity' => 'required|integer',
            'description' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.max' => 'El nombre no debe exceder los 30 caracteres',
            'type.required' => 'El tipo de categoría es requerido',
            'type.max' => 'El tipo no debe exceder los 20 caracteres',
            'quantity.required' => 'La cantidad es obligatoria',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'description.required' => 'La descripción es requerida',
            'description.max' => 'La descripción no debe exceder los 100 caracteres',
        ];
    }
}