<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'product_introduction' => 'nullable|string',
            'product_nature_id' => $this->isMethod('POST') ? 'required|exists:product_natures,id' : 'nullable|exists:product_natures,id',
            'brand_id' => $this->isMethod('POST') ? 'required|exists:brands,id' : 'nullable|exists:brands,id',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,mkv,avi,pdf,doc,docx',
            'productFeatureValues' => 'nullable|array',
            'productFeatureValues.*.product_nature_attribute_id' => $this->isMethod('POST') ? 'required|exists:product_nature_attributes,id' : 'nullable|exists:product_nature_attributes,id',
            'productFeatureValues.*.value' => $this->isMethod('POST') ? 'required|array' : 'nullable|array',
            'productFeatureValues.*.value.*' => 'string ',
            'relatedProducts' => 'nullable|array',
            'relatedProducts.*' => 'exists:products,id',
            'similarProducts' => 'nullable|array',
            'similarProducts.*' => 'exists:products,id'
        ];
    }
}
