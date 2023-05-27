<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'receiver' => 'nullable|max:120|min:1|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'deliverer' => 'nullable|max:120|min:1|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'description' => 'nullable|max:120|min:1|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
                'marketable_number' => 'required|numeric',
            ];
        } else {
            return [

                'marketable_number' => 'required|numeric',
                'sold_number' => 'required|numeric',
                'frozen_number' => 'required|numeric',
            ];
        }
    }
}
