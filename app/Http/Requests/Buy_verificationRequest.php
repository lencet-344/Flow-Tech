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
            'order_id' => 'required|integer|exists:orders,id',
        ];
    }

        public function messages(): array
    {
        return [
            'quantity.required' => 'El campo quantity es requerido',
            'quantity.integer' => 'El campo quantity debe ser un número entero',
            'date_buy.required' => 'El campo date buy es requerido',
            'date_buy.date' => 'El campo date buy debe ser una fecha válida',
            'iva.required' => 'El campo iva es requerido',
            'iva.numeric' => 'El campo iva debe ser numérico',
            'cost_total.required' => 'El campo cost total es requerido',
            'cost_total.numeric' => 'El campo cost total debe ser numérico',
            'order_id.required' => 'El campo order id es requerido',
            'order_id.integer' => 'El campo order id debe ser un número entero',
            'order_id.exists' => 'La referencia seleccionada en order id no existe',
        ];
    }
}