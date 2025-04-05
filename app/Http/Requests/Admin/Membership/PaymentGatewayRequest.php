<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class PaymentGatewayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'merchant_id' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'terminal_id' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'secret_key' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif',
        ];
    }
}
