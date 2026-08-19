<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class Buy_verificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'quantity' => 'required|integer',
            'date_buy' => 'required|date',
            'iva' => 'required|numeric',
            'cost_total' => 'required|numeric',
            'order_id' => 'nullable|integer|exists:orders,id',
        ];
    }

        public function messages(): array
    {
        return [
            'quantity.required' => 'El campo cantidad es requerido',
            'quantity.integer' => 'El campo cantidad debe ser un número entero',
            'date_buy.required' => 'El campo fecha de compra es requerido',
            'date_buy.date' => 'El campo fecha de compra debe ser una fecha válida',
            'iva.required' => 'El campo iva es requerido',
            'iva.numeric' => 'El campo iva debe ser numérico',
            'cost_total.required' => 'El campo costo total es requerido',
            'cost_total.numeric' => 'El campo costo total debe ser numérico',
            'order_id.nullable' => 'El campo orden id es opcional',
            'order_id.integer' => 'El campo orden id debe ser un número entero',
            'order_id.exists' => 'La referencia seleccionada en orden id no existe',
        ];
    }
}