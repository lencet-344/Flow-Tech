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
            'name' => 'required|string|max:30',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'type_product' => 'required|string|max:30',
            'date_trade' => 'required|date',
            'description' => 'required|string|max:100',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

        public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido',
            'name.max' => 'El campo name no debe exceder los 30 caracteres',
            'quantity.required' => 'El campo quantity es requerido',
            'quantity.integer' => 'El campo quantity debe ser un número entero',
            'price.required' => 'El campo price es requerido',
            'price.numeric' => 'El campo price debe ser numérico',
            'type_product.required' => 'El campo type product es requerido',
            'type_product.max' => 'El campo type product no debe exceder los 30 caracteres',
            'date_trade.required' => 'El campo date trade es requerido',
            'date_trade.date' => 'El campo date trade debe ser una fecha válida',
            'description.required' => 'El campo description es requerido',
            'description.max' => 'El campo description no debe exceder los 100 caracteres',
            'product_id.required' => 'El campo product id es requerido',
            'product_id.integer' => 'El campo product id debe ser un número entero',
            'product_id.exists' => 'La referencia seleccionada en product id no existe',
        ];
    }
}