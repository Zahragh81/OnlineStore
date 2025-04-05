<?php

namespace App\Http\Requests\Shop\Membership;

use Illuminate\Foundation\Http\FormRequest;

class OrderChangeStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'order_status_id' => 'required|exists:order_statuses,id'
        ];
    }
}
