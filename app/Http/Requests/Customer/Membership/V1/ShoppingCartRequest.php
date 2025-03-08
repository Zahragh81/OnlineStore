<?php

namespace App\Http\Requests\Customer\Membership\V1;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'unit_price' => 'required|numeric|min:0',
            'number' => 'required|integer|min:0',
            'product_balance_id' => 'required|exists:product_balances,id'
        ];
    }
}
