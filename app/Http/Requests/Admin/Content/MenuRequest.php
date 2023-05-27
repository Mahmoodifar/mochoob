<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,\/;&؟? ]+$/u',
            'url' => 'required|max:120|min:2|regex:/^[a-zA-Z0-9-][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/u',
            'status' => 'required|numeric|in:0,1',
            'parent_id' => 'nullable|min:1|max::10000000000|regex:/^[0-9]+$/u|exists:menus,id',
        ];
    }
}
