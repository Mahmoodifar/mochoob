<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'question' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,\/;&؟? ]+$/u',
            'answer' => 'required|max:300|min:5|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,><\/;\n\r&؟? ]+$/u',
            'tags' => 'required|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
            'status' => 'required|numeric|in:0,1',

        ];
    }
}
