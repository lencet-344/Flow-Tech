<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'inventory_id' => 'required|integer|exists:inventory,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'order_id.required' => 'La orden es requerida',
            'order_id.exists' => 'La orden seleccionada no existe',
            'product_id.required' => 'El producto es requerido',
            'product_id.exists' => 'El producto seleccionado no existe',
            'inventory_id.required' => 'El registro de inventario es requerido',
            'inventory_id.exists' => 'El registro de inventario seleccionado no existe',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser numérico',
        ];
    }
}