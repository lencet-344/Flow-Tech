<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'description' => 'required|string|max:100',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido',
            'name.max' => 'El campo name no debe exceder los 30 caracteres',
            'type.required' => 'El campo type es requerido',
            'type.max' => 'El campo type no debe exceder los 30 caracteres',
            'description.required' => 'El campo description es requerido',
            'description.max' => 'El campo description no debe exceder los 100 caracteres',
            'user_id.required' => 'El campo user id es requerido',
            'user_id.integer' => 'El campo user id debe ser un número entero',
            'user_id.exists' => 'La referencia seleccionada en user id no existe',
        ];
    }
}