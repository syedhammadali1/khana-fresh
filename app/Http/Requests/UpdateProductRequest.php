<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            // 'category_id' => 'required',
            'flavour_id' => 'required',
            'slug' => 'required',
            'stock' => 'required',
            'ingredient' => 'required|array',
            'nutrition' => 'required|array',
            'nutrition_amount' => 'required',
            'file' => 'nullable',
            'featured' => 'nullable',
            'halal' => 'nullable'
        ];
    }
}
