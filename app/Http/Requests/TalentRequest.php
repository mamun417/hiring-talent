<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class TalentRequest extends FormRequest
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
        $rules = [
            'talent_name' => 'required|string',
            'parent_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date_of_birth' => 'required',
            'gender' => 'required|string',
            'eye_color' => 'required|string',
            'hair_color' => 'required|string',
            'height' => 'required|string',
            'weight' => 'required|string',
            'shirt_size' => 'required|string',
            'pant_size' => 'required|string',
            'shoe_size' => 'required|string',
            'ethnicity_one' => 'required|string',
            'ethnicity_two' => 'required|string',
            'mail_address' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
            'imdb_page' => 'required|string',
            'la_casting_profile_link' => 'required|string',
            'actor_access_profile_link' => 'required|string',
            'website' => 'required|url',
            'represent_agency' => 'required|string',
        ];

        if (Auth::check() && isset(Auth::user()->talent)) {
            $rules['talent_image_one'] = 'nullable|image|max:5120';
            $rules['talent_image_two'] = 'nullable|image|max:5120';
            $rules['talent_image_three'] = 'nullable|image|max:5120';
            $rules['talent_image_four'] = 'nullable|image|max:5120';
            $rules['talent_resume'] = 'nullable|mimes:pdf|max:5120';
        } else {
            $rules['talent_image_one'] = 'required|image|max:5120';
            $rules['talent_image_two'] = 'required|image|max:5120';
            $rules['talent_image_three'] = 'required|image|max:5120';
            $rules['talent_image_four'] = 'required|image|max:5120';
            $rules['talent_resume'] = 'required|mimes:pdf|max:5120';
        }

        return $rules;

    }
}
