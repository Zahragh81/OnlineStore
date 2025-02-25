<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductNatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            'productNatureAttributes' => $this->isMethod('POST') ? 'required|array' : 'nullable|array',
            'productNatureAttribute_ids.*.productNatureAttributeId' => $this->isMethod('POST') ? 'required|integer|exists:product_nature_attributes,id' : 'nullable|integer|exists:product_nature_attributes,id',
            'productNatureAttribute_ids.*.admin_panel' => $this->isMethod('POST') ? 'required|boolean' : 'nullable|boolean',
            'store_type_id' => $this->isMethod('POST') ? 'required|integer|exists:store_types,id' : 'nullable|integer|exists:store_types,id',

        ];
    }
}
