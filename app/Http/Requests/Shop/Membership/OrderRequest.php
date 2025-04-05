<?php

namespace App\Http\Requests\Shop\Membership;

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
            'shipment_code' => 'nullable|string|max:255',
            'shipping_company_name' => 'nullable|string|max:255',
            'shipping_time' => 'nullable|date',
            'courier_id' => 'nullable|exists:couriers,id',
        ];
    }
}
