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
            'price_unitary' => 'required|numeric',
            'cost_total' => 'required|numeric',
            'date_delivery' => 'required|date',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'La cantidad es requerida',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'price_unitary.required' => 'El precio unitario es requerido',
            'price_unitary.numeric' => 'El precio unitario debe ser numérico',
            'cost_total.required' => 'El costo total es requerido',
            'cost_total.numeric' => 'El costo total debe ser numérico',
            'date_delivery.required' => 'La fecha de entrega es requerida',
            'date_delivery.date' => 'El formato de fecha de entrega no es válido',
            'user_id.required' => 'El usuario es requerido',
            'user_id.exists' => 'El usuario seleccionado no existe',
        ];
    }
}