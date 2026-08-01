<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'address' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:suppliers,email',
            'telephone' => 'required|integer|unique:suppliers,telephone',
            'identification_card' => 'required|string|max:20|unique:suppliers,identification_card',
            'company' => 'required|string|max:50',
            'code_company' => 'required|string|max:20',
            'No_INSS' => 'required|string|max:20|unique:suppliers,No_INSS',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no debe exceder los 50 caracteres',
            'age.required' => 'La edad es requerida',
            'age.integer' => 'La edad debe ser un número entero',
            'gender.required' => 'El género es requerido',
            'gender.max' => 'El género no debe exceder los 10 caracteres',
            'address.required' => 'La dirección es requerida',
            'address.max' => 'La dirección no debe exceder los 100 caracteres',
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo debe tener un formato válido',
            'email.max' => 'El correo no debe exceder los 50 caracteres',
            'email.unique' => 'El correo ya está registrado',
            'telephone.required' => 'El teléfono es requerido',
            'telephone.integer' => 'El teléfono debe ser un número entero',
            'telephone.unique' => 'Este número de teléfono ya está registrado',
            'identification_card.required' => 'La cédula de identidad es requerida',
            'identification_card.max' => 'La cédula de identidad no debe exceder los 20 caracteres',
            'identification_card.unique' => 'Esta cédula de identidad ya está registrada',
            'company.required' => 'La empresa es requerida',
            'company.max' => 'La empresa no debe exceder los 50 caracteres',
            'code_company.required' => 'El código de empresa es requerido',
            'code_company.max' => 'El código de empresa no debe exceder los 20 caracteres',
            'No_INSS.required' => 'El número INSS es requerido',
            'No_INSS.max' => 'El número INSS no debe exceder los 20 caracteres',
            'No_INSS.unique' => 'Este número INSS ya está registrado',
        ];
    }
}