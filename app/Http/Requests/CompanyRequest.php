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
        $id = $this->route('company') ? ($this->route('company')->id ?? $this->route('company')) : null;
        
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:50|unique:companies,email,' . $id,
            'address' => 'required|string|max:100',
            'telephone' => 'required|integer|unique:companies,telephone,' . $id,
            'type_product' => 'nullable|string|max:30',
            'description' => 'nullable|string',
            'website' => 'nullable|string|max:100',
            'horario' => 'nullable|string|max:100',
            'category_id' => 'nullable|integer|exists:categories,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la empresa es requerido',
            'name.max' => 'El nombre no debe exceder los 30 caracteres',
            'email.required' => 'El correo electrónico es requerido',
            'email.email' => 'Debe ingresar un formato de correo válido',
            'email.max' => 'El correo electrónico no debe exceder los 50 caracteres',
            'email.unique' => 'El correo electrónico ya está registrado',
            'address.required' => 'La dirección es requerida',
            'address.max' => 'La dirección no debe exceder los 100 caracteres',
            'telephone.required' => 'El teléfono es requerido',
            'telephone.integer' => 'El teléfono debe ser un número entero',
            'telephone.unique' => 'Este número de teléfono ya está registrado',
            'type_product.required' => 'El tipo de producto es requerido',
            'type_product.max' => 'El tipo de producto no debe exceder los 30 caracteres',
        ];
    }
}