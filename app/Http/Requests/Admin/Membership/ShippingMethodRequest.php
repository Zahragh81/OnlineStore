<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class ShippingMethodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'price' => $this->isMethod('POST') ? 'required|numeric|min:0' : 'nullable|numeric|min:0',
        ];
    }
}
