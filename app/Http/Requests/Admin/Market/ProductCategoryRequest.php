<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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

        if ($this->isMethod('post')) {

            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'description' => 'required|max:300|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,><\/;\n\r& ]+$/u',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'parent_id' => 'nullable|min:1|max::10000000000|regex:/^[0-9]+$/u|exists:product_categories,id',
                'tags' => 'required|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'show_in_menu' => 'required|numeric|in:0,1',

            ];
        } else {
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'description' => 'required|max:300|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,><\/;\n\r& ]+$/u',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'parent_id' => 'nullable    |min:1|max::10000000000|regex:/^[0-9]+$/u|exists:product_categories,id',
                'tags' => 'required|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'show_in_menu' => 'required|numeric|in:0,1',
            ];
        }
    }
};
