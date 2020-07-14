<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'reg_address' => ['required', 'string', 'max:255'],
            'org' => ['required', 'string', 'max:255'],
            'email' => 'nullable|email|unique:users,email,' . $this->user_id,
            'phone' => 'required|string|unique:users,phone,' . $this->user_id,
            'inn' => 'nullable|string|max:40|unique:users,inn,' . $this->user_id,
            'work_with_nds' => ['boolean'],
            'photo' => ['nullable', 'image', 'max:1000', 'mimes:jpeg,png'],
            //'group_id' => 'exists:user_groups,allow_register',
        ];

    }
}

