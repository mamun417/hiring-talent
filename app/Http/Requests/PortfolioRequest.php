<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PortfolioRequest extends FormRequest
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
            'description'   => "nullable|string",
            'sub_title'     => "nullable|string|max:230",
            'title'         => "nullable|string|max:230",
            'image_1' => 'nullable|image',
            'image_2' => 'nullable|image',
            'image_3' => 'nullable|image',
            'image_4' => 'nullable|image',
        ];
    }
}
