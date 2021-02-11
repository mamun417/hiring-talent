<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'address' =>  ['nullable', 'string', 'max:200'],
            'phone_1' =>  ['nullable', 'max:30'],
            'phone_2' =>  ['nullable', 'max:30'],
            'telephone' => ['nullable', 'max:30'],
            'email' => ['nullable','email'],
            'fax' => ['nullable'],
        ];
    }
}
