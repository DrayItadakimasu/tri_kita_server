<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class driverRequest extends FormRequest
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
            'phone' => ['required', 'string', 'max:255'],

            'drive_front' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
            'drive_back' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],

            'passport_front' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
            'passport_back' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
        ];
    }
}
