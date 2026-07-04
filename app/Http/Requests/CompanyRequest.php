<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'type_product' => 'required|string|max:255',
            'production' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la empresa es requerido',
            'email.required' => 'El correo electrónico es requerido',
            'email.email' => 'Debe ingresar un formato de correo válido',
            'address.required' => 'La dirección es requerida',
            'type_product.required' => 'El tipo de producto es requerido',
            'production.required' => 'La producción es requerida',
        ];
    }
}