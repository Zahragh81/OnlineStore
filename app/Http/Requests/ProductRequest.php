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
//        'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
//            'product_introduction' => 'nullable|string',
//            'product_nature_id' => $this->isMethod('POST') ? 'required|exists:product_natures,id' : 'nullable|exists:product_natures,id',
//            'brand_id' => $this->isMethod('POST') ? 'required|exists:brands,id' : 'nullable|exists:brands,id',
//            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mkv,avi,pdf,doc,docx',
////            'productFeatureValues' => 'nullable|array',
////            'productFeatureValues.*.type' => $this->isMethod('POST') ? 'required|string' : 'nullable|string',
////            'productFeatureValues.*.collection' => 'nullable|array',
//            'productFeatureValues' => 'nullable|array',
//            'productFeatureValues.*.type' => 'required|string|in:numeric,collection', // اصلاح برای الزامی بودن و نوع خاص
//            'productFeatureValues.*.value' => 'required', // فرضاً برای اطمینان از مقدار value در هر feature
//            'productFeatureValues.*.collection' => 'nullable|array',
//
//            'relatedProducts' => 'nullable|array',
//            'relatedProducts.*' => 'exists:products,id',
//            'similarProducts' => 'nullable|array',
//            'similarProducts.*' => 'exists:products,id'




            'name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'product_introduction' => 'nullable|string',
            'product_nature_id' => $this->isMethod('POST') ? 'required|exists:product_natures,id' : 'nullable|exists:product_natures,id',
            'brand_id' => $this->isMethod('POST') ? 'required|exists:brands,id' : 'nullable|exists:brands,id',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,mkv,avi,pdf,doc,docx',
            'productFeatureValues' => 'nullable|array',
            'relatedProducts' => 'nullable|array',
            'relatedProducts.*' => 'exists:products,id',
            'similarProducts' => 'nullable|array',
            'similarProducts.*' => 'exists:products,id'
        ];
    }
}
