<?php

namespace App\Http\Requests\Customer\Membership\V1;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'address_2' => 'nullable|string',
            'mobile' => 'required|regex:/^09[0-9]{9}$/',
            'phone' => 'nullable|regex:/^\d{11}$/',
            'postal_code' => 'required|string|size:10',
            'shipping_cost' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'final_amount_payable' => 'required|numeric|min:0',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'payment_gateway_id' => 'nullable|exists:payment_gateways,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'order_items' => 'required|array',
            'order_items.*.number' => 'required|integer',
            'order_items.*.per_unit' => 'required|numeric',
            'order_items.*.total_amount' => 'required|numeric',
            'order_items.*.product_balance_id' => 'required|exists:product_balances,id',
        ];
    }
}
