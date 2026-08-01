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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'Debe ingresar un formato de correo válido',
            'email.unique' => 'Este email ya está registrado',
            'password.required' => 'El campo password es requerido',
        ];
    }
}