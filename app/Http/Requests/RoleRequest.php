<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $id = $this->role->id ?? null;
        return [
            'name' => 'required|unique:roles,name,' . $id,
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'required',
        ];
    }
}
