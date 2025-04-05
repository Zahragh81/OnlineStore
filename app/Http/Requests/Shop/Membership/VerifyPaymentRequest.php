<?php

namespace App\Http\Requests\Shop\Membership;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'payment_id' => 'required|exists:transactions,payment_id',
            'authority' => 'required|string',
        ];
    }
}
