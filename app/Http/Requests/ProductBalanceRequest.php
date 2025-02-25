<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductBalanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'price' => $this->isMethod('POST') ? 'required|numeric|min:0' : 'nullable|numeric|min:0',
            'number' => $this->isMethod('POST') ? 'required|integer|min:0' : 'nullable|integer|min:0',
            'product_id' => $this->isMethod('POST') ? 'required|exists:products,id' : 'nullable|exists:products,id',
            'productBalanceAttributes' => $this->isMethod('POST') ? 'required|array' : 'nullable|array',
            'productBalanceAttributes.*.product_nature_attribute_id' => $this->isMethod('POST') ? 'required|exists:product_nature_attributes,id' : 'nullable|exists:product_nature_attributes,id',
            'productBalanceAttributes.*.value' => $this->isMethod('POST') ? 'required|array' : 'nullable|array',
        ];
    }
}
