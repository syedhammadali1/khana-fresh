<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        $password = '';
        if ($this->password) {
            $password = 'required|min:8';
        }
        return [
            'first_name' => 'nullable|min:3',
            'last_name' => 'nullable|min:3',
            'zip' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $this->user->id,
            // 'password' => $password,
            'status' => 'required',
        ];
    }
}
