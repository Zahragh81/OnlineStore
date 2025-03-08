<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'title' => $this->isMethod('POST') ? 'required|string|max:255' : ' nullable|string|max:255',
            'address' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'postal_code' => 'nullable|string|size:10',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'mobile' => $this->isMethod('POST') ? 'required|digits:11' : 'nullable|digits:11',
            'phone' => $this->isMethod('POST') ? 'required|digits_between:8,15' : 'nullable|digits_between:8,15',
            'owner' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'city_id' => $this->isMethod('POST') ? 'required|exists:cities,id' : 'nullable|exists:cities,id',
            'storeType_ids' => 'required|array',
            'storeType_ids.*' => 'exists:store_types,id',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif',
        ];
    }
}
