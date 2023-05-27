<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValueRequest extends FormRequest
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
            'value' => 'required|max:120|regex:/^[a-zA-Z0-9, ]+$/u',
            'type' => 'required|numeric|in:0,1',
            'product_id' => 'required|min:1|max::10000000000|regex:/^[0-9]+$/u|exists:products,id',
            'price_increase' => 'required|numeric',

        ];
    }
}
