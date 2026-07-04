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
            'name' => 'required|string|max:255',
            'age' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'gmail' => 'required|string|email|max:255',
            'telephone' => 'required|string|unique:suppliers,telephone',
            'identification_card' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'code_employee' => 'required|string|max:255',
            'no_inss' => 'required|string|max:255',
            'booking_idbooking' => 'required|integer|exists:booking,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'age.required' => 'La edad es requerida',
            'gender.required' => 'El género es requerido',
            'address.required' => 'La dirección es requerida',
            'gmail.required' => 'El correo es requerido',
            'gmail.email' => 'El correo debe tener un formato válido',
            'telephone.required' => 'El teléfono es requerido',
            'telephone.unique' => 'Este número de teléfono ya está registrado',
            'identification_card.required' => 'La cédula de identidad es requerida',
            'company.required' => 'La empresa es requerida',
            'code_employee.required' => 'El código de empleado es requerido',
            'no_inss.required' => 'El número INSS es requerido',
            'booking_idbooking.required' => 'La reserva es requerida',
            'booking_idbooking.exists' => 'La reserva seleccionada no existe',
        ];
    }
}