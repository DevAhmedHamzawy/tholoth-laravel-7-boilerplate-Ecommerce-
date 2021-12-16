<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'main_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
            'category_id' => 'required|numeric',
            'code' => 'required|numeric',
            'name' => 'required',
        ];
    }
}
