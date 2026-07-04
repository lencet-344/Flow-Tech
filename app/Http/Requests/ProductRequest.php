<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'cost' => 'required|numeric',
            'presentation' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'code_bar' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'company_id' => 'required|integer|exists:company,id',
            'offer_id' => 'required|integer|exists:offer,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es requerido',
            'type.required' => 'El tipo de producto es requerido',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.integer' => 'La cantidad debe ser un número entero',
            'cost.required' => 'El costo es requerido',
            'cost.numeric' => 'El costo debe ser numérico',
            'presentation.required' => 'La presentación es requerida',
            'state.required' => 'El estado es requerido',
            'code_bar.required' => 'El código de barras es requerido',
            'category_id.required' => 'La categoría es requerida',
            'category_id.exists' => 'La categoría seleccionada no existe',
            'brand_id.required' => 'La marca es requerida',
            'brand_id.exists' => 'La marca seleccionada no existe',
            'company_id.required' => 'La empresa es requerida',
            'company_id.exists' => 'La empresa seleccionada no existe',
            'offer_id.required' => 'La oferta es requerida',
            'offer_id.exists' => 'La oferta seleccionada no existe',
        ];
    }
}