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
            'payment_status' => 'required|string|max:255',
            'special_request' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'date_booking.required' => 'La fecha de reserva es requerida',
            'date_booking.date' => 'El formato de fecha no es válido',
            'total_amount.required' => 'El monto total es requerido',
            'total_amount.numeric' => 'El monto total debe ser un valor numérico',
            'deposit_amount.required' => 'El monto de depósito es requerido',
            'deposit_amount.numeric' => 'El monto de depósito debe ser un valor numérico',
            'payment_status.required' => 'El estado de pago es requerido',
            'special_request.max' => 'La petición especial no debe exceder los 500 caracteres',
        ];
    }
}