<?php

namespace App\Http\Requests\Shop\Membership;

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
            'store_id' => $this->isMethod('POST') ? 'required|exists:stores,id' : 'nullable|exists:stores,id',
            'productBalanceAttributes' => 'nullable|array',
            'productBalanceAttributes.*.product_nature_attribute_id' => 'nullable|exists:product_nature_attributes,id',
            'productBalanceAttributes.*.value' => 'nullable|array',
        ];
    }
}
