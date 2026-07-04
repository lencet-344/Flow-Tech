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
            'tittle' => 'required|string|max:255',
            'type_offer' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'tittle.required' => 'El título de la oferta es requerido',
            'type_offer.required' => 'El tipo de oferta es requerido',
            'discount.required' => 'El descuento es requerido',
            'discount.numeric' => 'El descuento debe ser un valor numérico',
            'description.max' => 'La descripción no debe exceder los 500 caracteres',
        ];
    }
}