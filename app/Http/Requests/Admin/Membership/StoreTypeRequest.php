<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'productGroupType_ids' => 'required|array',
            'productGroupType_ids.*' => 'exists:product_group_types,id'
        ];
    }
}
