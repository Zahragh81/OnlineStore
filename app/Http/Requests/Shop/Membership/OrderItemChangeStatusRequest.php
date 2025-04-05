<?php

namespace App\Http\Requests\Shop\Membership;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemChangeStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'order_item_status_id' => 'required|exists:order_item_statuses,id',
            'order_items_id' => 'required|array',
            'order_items_id.*' => 'required|exists:order_items,id'
        ];
    }
}
