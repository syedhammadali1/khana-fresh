<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
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
            'holder_name' => 'required',
            'card_name' => 'required|integer',
            // 'cvc' => 'required',
            'expiry_date' => 'required|after:' . date('Y-m-d'),
        ];
    }
}
