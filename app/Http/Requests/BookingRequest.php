<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'date_booking' => 'required|date',
            'total_amount' => 'required|numeric',
            'deposit_amount' => 'required|numeric',
            'payment_method' => 'required|string|max:30',
            'special_requests' => 'required|string|max:100',
            'supplier_id' => 'required|integer|exists:suppliers,id',
        ];
    }

        public function messages(): array
    {
        return [
            'date_booking.required' => 'El campo date booking es requerido',
            'date_booking.date' => 'El campo date booking debe ser una fecha válida',
            'total_amount.required' => 'El campo total amount es requerido',
            'total_amount.numeric' => 'El campo total amount debe ser numérico',
            'deposit_amount.required' => 'El campo deposit amount es requerido',
            'deposit_amount.numeric' => 'El campo deposit amount debe ser numérico',
            'payment_method.required' => 'El campo payment method es requerido',
            'payment_method.max' => 'El campo payment method no debe exceder los 30 caracteres',
            'special_requests.required' => 'El campo special requests es requerido',
            'special_requests.max' => 'El campo special requests no debe exceder los 100 caracteres',
            'supplier_id.required' => 'El campo supplier id es requerido',
            'supplier_id.integer' => 'El campo supplier id debe ser un número entero',
            'supplier_id.exists' => 'La referencia seleccionada en supplier id no existe',
        ];
    }
}