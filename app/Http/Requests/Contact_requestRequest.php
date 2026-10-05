<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Contact_requestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        $id = $this->route('contact_request') ? ($this->route('contact_request')->id ?? $this->route('contact_request')) : null;

        return [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:contact_requests,email,' . $id,
            'telephone' => 'required|numeric|digits_between:7,8|unique:contact_requests,telephone,' . $id,
            'location' => 'nullable|string|max:30',
            'company_id' => 'nullable|integer|exists:companies,id',
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido',
            'name.max' => 'El campo name no debe exceder los 30 caracteres',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'Debe ingresar un formato de correo válido',
            'email.max' => 'El campo email no debe exceder los 30 caracteres',
            'email.unique' => 'Este email ya está registrado',
            'telephone.required' => 'El campo telephone es requerido',
            'telephone.numeric' => 'El teléfono debe ser numérico',
            'telephone.digits_between' => 'El teléfono debe tener entre 7 y 8 dígitos',
            'telephone.unique' => 'Este telephone ya está registrado',
            'location.required' => 'El campo location es requerido',
            'location.max' => 'El campo location no debe exceder los 30 caracteres',
            'company_id.required' => 'El campo company id es requerido',
            'company_id.integer' => 'El campo company id debe ser un número entero',
            'company_id.exists' => 'La referencia seleccionada en company id no existe',
        ];
    }
}