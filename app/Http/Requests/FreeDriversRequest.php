<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\clients\FreeDrivers;
use Gate;

class FreeDriversRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', FreeDrivers::Class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['string', 'min:8'],
            'place' => ['required', 'string', 'max:255'],
            //'place' => ['required', 'string', 'max:255'],
        ];
    }
}
