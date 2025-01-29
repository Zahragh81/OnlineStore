<?php

namespace App\Http\Requests;

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
            'title' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'address' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'postal_code' => 'nullable|string|size:10',
//            'latitude' => $this->isMethod('POST') ? 'required|numeric|between:-90,90' : 'nullable|numeric|between:-90,90',
//            'longitude' => $this->isMethod('POST') ? 'required|numeric|between:-180,180' : 'nullable|numeric|between:-180,180',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'mobile' => $this->isMethod('POST') ? 'required|digits:11' : 'nullable|digits:11',
            'phone' => $this->isMethod('POST') ? 'required|digits_between:8,15' : 'nullable|digits_between:8,15',
            'owner' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'city_id' => $this->isMethod('POST') ? 'required|exists:cities,id' : 'nullable|exists:cities,id',
            'store_type_id' => $this->isMethod('POST') ? 'required|exists:store_types,id' : 'nullable|exists:store_types,id',
//            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:min_width:400,min_height=400,max_width=400,max_height=400',
//            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|dimensions:min_width:12800,min_height=720,max_width=1280,max_height=720',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
