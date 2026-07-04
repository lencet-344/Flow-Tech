<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TradeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'name_product' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'type_product' => 'required|string|max:255',
            'trade_date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'El producto es requerido',
            'product_id.exists' => 'El producto seleccionado no existe',
            'name_product.required' => 'El nombre del producto es requerido',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un valor numérico',
            'type_product.required' => 'El tipo de producto es requerido',
            'trade_date.required' => 'La fecha de transacción es requerida',
            'trade_date.date' => 'El formato de fecha no es válido',
        ];
    }
}