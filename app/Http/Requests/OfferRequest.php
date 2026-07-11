<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'title' => 'required|string|max:30',
            'type_offer' => 'required|string|max:30',
            'discount' => 'required|numeric',
            'description' => 'required|string|max:100',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

        public function messages(): array
    {
        return [
            'title.required' => 'El campo title es requerido',
            'title.max' => 'El campo title no debe exceder los 30 caracteres',
            'type_offer.required' => 'El campo type offer es requerido',
            'type_offer.max' => 'El campo type offer no debe exceder los 30 caracteres',
            'discount.required' => 'El campo discount es requerido',
            'discount.numeric' => 'El campo discount debe ser numérico',
            'description.required' => 'El campo description es requerido',
            'description.max' => 'El campo description no debe exceder los 100 caracteres',
            'product_id.required' => 'El campo product id es requerido',
            'product_id.integer' => 'El campo product id debe ser un número entero',
            'product_id.exists' => 'La referencia seleccionada en product id no existe',
        ];
    }
}