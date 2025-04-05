<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class CourierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'plate_number' => $this->isMethod('POST') ? 'required|string|max:255|unique:couriers,plate_number' : 'nullable|string|max:255',
            'vehicle_name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'user_id' => $this->isMethod('POST') ? 'required|exists:users,id' : 'nullable|exists:users,id',
            'courier_type_id' => $this->isMethod('POST') ? 'required|exists:courier_types,id' : 'nullable|exists:courier_types,id'
        ];
    }
}
