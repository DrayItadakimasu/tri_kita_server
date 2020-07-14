<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class carRequest extends FormRequest
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
            'car_number' => ['required', 'string', 'max:25'],
            'sts_back' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
            'sts_front' => ['required', 'image', 'max:1000', 'mimes:jpeg,png'],
        ];
    }
}
