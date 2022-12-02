<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

          'first_name' => 'required',
          'last_name' => 'required',
          'city' => 'required',
          'state' => 'required',
          'address' => 'required',
          'address2' => 'nullable',
          'phone' => 'required',

        ];
    }
}
