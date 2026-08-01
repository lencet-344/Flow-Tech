<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'quantity' => 'required|integer',
            'batch_number' => 'required|integer',
            'unit_cost' => 'required|numeric',
            'status' => 'required|string|max:30',
            'last_restock' => 'required|date',
            'update_restock' => 'required|date',
            'product_id' => 'required|integer|exists:products,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'order_detail_id' => 'required|integer|exists:order_details,id',
        ];
    }

        public function messages(): array
    {
        return [
            'quantity.required' => 'El campo quantity es requerido',
            'quantity.integer' => 'El campo quantity debe ser un número entero',
            'batch_number.required' => 'El campo batch number es requerido',
            'batch_number.integer' => 'El campo batch number debe ser un número entero',
            'unit_cost.required' => 'El campo unit cost es requerido',
            'unit_cost.numeric' => 'El campo unit cost debe ser numérico',
            'status.required' => 'El campo status es requerido',
            'status.max' => 'El campo status no debe exceder los 30 caracteres',
            'last_restock.required' => 'El campo last restock es requerido',
            'last_restock.date' => 'El campo last restock debe ser una fecha válida',
            'update_restock.required' => 'El campo update restock es requerido',
            'update_restock.date' => 'El campo update restock debe ser una fecha válida',
            'product_id.required' => 'El campo product id es requerido',
            'product_id.integer' => 'El campo product id debe ser un número entero',
            'product_id.exists' => 'La referencia seleccionada en product id no existe',
            'supplier_id.required' => 'El campo supplier id es requerido',
            'supplier_id.integer' => 'El campo supplier id debe ser un número entero',
            'supplier_id.exists' => 'La referencia seleccionada en supplier id no existe',
            'order_detail_id.required' => 'El campo order detail id es requerido',
            'order_detail_id.integer' => 'El campo order detail id debe ser un número entero',
            'order_detail_id.exists' => 'La referencia seleccionada en order detail id no existe',
        ];
    }
}