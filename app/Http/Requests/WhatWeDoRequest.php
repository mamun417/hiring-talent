<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhatWeDoRequest extends FormRequest
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
        $id = $this->whatWeDo->id ?? null;
        return [
            'title' => 'required|string|max:255' . $id,
            'sub_title' => 'required|string|max:255',
            'youtube_link_1' => 'required|url',
            'youtube_link_2' => 'required|url',
            'description' => 'required|string',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => '"Title"',
            'sub_title' => '"Subtitle"',
            'youtube_link_1' => '"Youtube Link 1"',
            'youtube_link_2' => '"Youtube Link 2"',
            'description' => '"Description"',
        ];
    }
}
