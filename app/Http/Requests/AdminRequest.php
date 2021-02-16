<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $admin_id = $this->admin->id ?? null;

        $rules = [
            'name' => "required|string|max:50",
            'type' => "required|array",
            'type.*' => "required",
            'email' => 'required|email|unique:admins,email,' . $admin_id,
        ];

        if (request()->isMethod('post')) {
            $rules['image'] = 'nullable|mimes:jpg,jpeg,bmp,png|max:8192';
            $rules['password'] = "required|min:8";
            $rules['confirm_password'] = 'required|min:8|same:password';
        }

        if (request()->isMethod('put') || request()->isMethod('patch')) {
            $rules['image'] = 'nullable|mimes:jpg,jpeg,bmp,png|max:8192';
            $rules['password'] = "nullable|min:8";
        }

        return $rules;
    }
}
