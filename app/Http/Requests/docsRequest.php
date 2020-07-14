<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class docsRequest extends FormRequest
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

            'inn' => ['required', 'string', 'max:255'],
            'agency_name' => ['required', 'string', 'max:255'],
            'ogrn' => ['required', 'string', 'max:255'],
            'passport_series' => ['required', 'string', 'max:255'],
            'passport_number' => ['required', 'string', 'max:255'],

            'inn_image' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
            'ogrn_image' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],

            'passport_front' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
            'passport_back' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
        ];
    }
}
