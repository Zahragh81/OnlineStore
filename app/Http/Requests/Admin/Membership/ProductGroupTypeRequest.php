<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class ProductGroupTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'productGroupTypeItems_ids' => $this->isMethod('POST') ? 'required|array' : 'nullable|array',
            'productGroupTypeItems_ids.*' => 'exists:product_group_type_items,id'
        ];
    }
}
