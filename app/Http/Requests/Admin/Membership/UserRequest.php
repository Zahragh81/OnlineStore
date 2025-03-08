<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'first_name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'last_name' => $this->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'username' => $this->isMethod('POST') ? "required|unique:users,username,{$this->user?->id}|digits:10" : "nullable|unique:users,username,{$this->user?->id}|digits:10",
            'mobile' => $this->isMethod('POST') ? 'required|digits:11|unique:users,mobile,' . $this->user?->id : 'nullable|digits:11|unique:users,mobile,' . $this->user?->id,
            'store_ids' => 'nullable|array',
            'store_ids.*' => 'integer|exists:stores,id'
        ];
    }
}
