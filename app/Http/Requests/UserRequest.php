<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = $this->user->id ?? null;

        $rules = [
            'name' => "required|string|max:50",
            'email' => 'required|email|unique:users,email,' . $user_id,
        ];

        if (request()->isMethod('post')) {
            $rules['image'] = 'nullable|mimes:jpg,jpeg,bmp,png|max:8192';
        }

        if (request()->isMethod('put') || request()->isMethod('patch')) {
            $rules['image'] = 'nullable|mimes:jpg,jpeg,bmp,png|max:8192';
        }


        return $rules;
    }
}
