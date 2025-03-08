<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class ProductNatureAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'description' => 'nullable|string',
            'product_nature_attribute_type_id' => $this->isMethod('POST') ? 'required|integer|exists:product_nature_attribute_types,id' : 'nullable|integer|exists:product_nature_attribute_types,id',
//            'productNatureAttributeItem_ids' => $this->isMethod('POST') ? 'required|array' : 'nullable|array',
            'productNatureAttributeItem_ids' => 'nullable|array',
            'productNatureAttributeItem_ids.*' => 'exists:product_nature_attribute_items,id'
        ];
    }
}
