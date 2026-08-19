<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'date_delivery' => 'required|date',
            'buy_verifications_id' => 'nullable|integer|exists:buy_verifications,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

        public function messages(): array
    {
        return [
            'quantity.required' => 'El campo quantity es requerido',
            'quantity.integer' => 'El campo quantity debe ser un número entero',
            'price.required' => 'El campo price es requerido',
            'price.numeric' => 'El campo price debe ser numérico',
            'cost.required' => 'El campo cost es requerido',
            'cost.numeric' => 'El campo cost debe ser numérico',
            'date_delivery.required' => 'El campo date delivery es requerido',
            'date_delivery.date' => 'El campo date delivery debe ser una fecha válida',
            'buy_verification_id.required' => 'El campo buy verification id es requerido',
            'buy_verification_id.integer' => 'El campo buy verification id debe ser un número entero',
            'buy_verification_id.exists' => 'La referencia seleccionada en buy verification id no existe',
            'user_id.required' => 'El campo user id es requerido',
            'user_id.integer' => 'El campo user id debe ser un número entero',
            'user_id.exists' => 'La referencia seleccionada en user id no existe',
        ];
    }
}