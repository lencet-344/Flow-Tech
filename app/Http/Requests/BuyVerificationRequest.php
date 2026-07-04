<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|integer|exists:orders,id',
            'quantity' => 'required|integer',
            'date_buy' => 'required|date',
            'iva' => 'required|numeric',
            'cost_total' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'order_id.required' => 'La orden es requerida',
            'order_id.exists' => 'La orden seleccionada no existe',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'date_buy.required' => 'La fecha de compra es requerida',
            'date_buy.date' => 'El formato de fecha no es válido',
            'iva.required' => 'El IVA es requerido',
            'iva.numeric' => 'El IVA debe ser un valor numérico',
            'cost_total.required' => 'El costo total es requerido',
            'cost_total.numeric' => 'El costo total debe ser un valor numérico',
        ];
    }
}