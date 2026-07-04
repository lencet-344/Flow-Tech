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
            'product_id' => 'required|integer|exists:products,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'quantity' => 'required|integer',
            'batch_number' => 'required|string|max:255',
            'unit_cost' => 'required|numeric',
            'status' => 'required|string|max:255',
            'last_restocked' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'El producto es requerido',
            'product_id.integer' => 'El producto debe ser un número entero',
            'product_id.exists' => 'El producto seleccionado no existe',
            'supplier_id.required' => 'El proveedor es requerido',
            'supplier_id.integer' => 'El proveedor debe ser un número entero',
            'supplier_id.exists' => 'El proveedor seleccionado no existe',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'batch_number.required' => 'El número de lote es requerido',
            'batch_number.string' => 'El número de lote debe ser un texto válido',
            'unit_cost.required' => 'El costo unitario es requerido',
            'unit_cost.numeric' => 'El costo unitario debe ser un valor numérico',
            'status.required' => 'El estado es requerido',
            'status.string' => 'El estado debe ser un texto válido',
            'last_restocked.required' => 'La fecha de reabastecimiento es requerida',
            'last_restocked.date' => 'El formato de fecha no es válido',
        ];
    }
}