<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => 'required|integer|exists:company,id',
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|unique:contact_request,telephone',
            'email' => 'required|string|email|max:255',
            'location' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'La empresa es requerida',
            'company_id.exists' => 'La empresa seleccionada no existe',
            'name.required' => 'El nombre es requerido',
            'telephone.required' => 'El teléfono es requerido',
            'telephone.unique' => 'Este teléfono ya está registrado',
            'email.required' => 'El correo electrónico es requerido',
            'email.email' => 'Debe ingresar un formato de correo válido',
            'location.required' => 'La ubicación es requerida',
        ];
    }
}