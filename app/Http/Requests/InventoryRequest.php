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
            'batch_number' => 'nullable|integer',
            'unit_cost' => 'required|numeric',
            'status' => 'nullable|string|max:30',
            'last_restock' => 'required|date',
            'update_restock' => 'required|date',
            'product_id' => 'nullable|integer|exists:products,id',
            'product_name' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|integer|exists:suppliers,id',
            'presentation' => 'required|string|max:50',
        ];
    }

        public function messages(): array
    {
        return [
            'quantity.required' => 'El campo quantity es requerido',
            'quantity.integer' => 'El campo quantity debe ser un número entero',
            'unit_cost.required' => 'El campo unit cost es requerido',
            'unit_cost.numeric' => 'El campo unit cost debe ser numérico',
            'last_restock.required' => 'El campo last restock es requerido',
            'last_restock.date' => 'El campo last restock debe ser una fecha válida',
            'update_restock.required' => 'El campo update restock es requerido',
            'update_restock.date' => 'El campo update restock debe ser una fecha válida',
            'product_id.exists' => 'La referencia seleccionada en product id no existe',
            'supplier_id.exists' => 'La referencia seleccionada en supplier id no existe',
            'presentation.required' => 'La unidad de medida o presentación es requerida',
        ];
    }
}
