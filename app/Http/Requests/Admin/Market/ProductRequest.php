<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'introduction' => 'required|max:3000|min:2',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'category_id' => 'required|min:1|max:10000000000|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|max:10000000000|regex:/^[0-9]+$/u|exists:brands,id',
                'tags' => 'required|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'published_at' => 'required|numeric',
                'weight' => 'required|min:1|max:10000|integer',
                'length' => 'required|min:1|max:10000|integer',
                'width' => 'required|min:1|max:10000|integer',
                'height' => 'required|min:1|max:10000|integer',
                'price' => 'required|numeric',
            ];
        } else {
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'introduction' => 'required|max:3000|min:2',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'category_id' => 'required|min:1|max:10000000000|regex:/^[0-9]+$/u|exists:product_categories,id',
                'brand_id' => 'required|min:1|max:10000000000',
                'tags' => 'required|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'published_at' => 'required|numeric',
                'weight' => 'required|min:1|max:10000|numeric',
                'length' => 'required|min:1|max:10000|numeric',
                'width' => 'required|min:1|max:10000|numeric',
                'height' => 'required|min:1|max:10000|numeric',
                'price' => 'required|numeric',
            ];
        }
    }
}
