<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'age' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'telephone' => 'required|string|unique:users,telephone',
            'email' => 'required|string|email|max:255',
            'identification_card' => 'required|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'age.required' => 'La edad es requerida',
            'gender.required' => 'El género es requerido',
            'telephone.required' => 'El teléfono es requerido',
            'telephone.unique' => 'Este teléfono ya está registrado',
            'email.required' => 'El correo electrónico es requerido',
            'email.email' => 'Debe ingresar un formato de correo válido',
            'identification_card.required' => 'La cédula de identidad es requerida',
            'role_id.required' => 'El rol de usuario es requerido',
            'role_id.exists' => 'El rol seleccionado no existe',
        ];
    }
}