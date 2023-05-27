<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class SMSRequest extends FormRequest
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
            'title' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي., ]+$/u',
            'body' => 'required|max:300|min:5|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,& ]+$/u',
            'status' => 'required|numeric|in:0,1',
            'published_at' => 'required|numeric',
        ];
    }
}
