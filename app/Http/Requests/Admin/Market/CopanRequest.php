<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CopanRequest extends FormRequest
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
            'code' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,-ـ ]+$/u',
            'user_id' => 'required_if:type,==,1|min:1|max:10000000000|regex:/^[0-9]+$/u|exists:users,id',
            'discount_ceiling' => 'required|min:1|max:100000000|numeric',
            'status' => 'required|numeric|in:0,1',
            'amount' => [(request()->amount_type == 0) ? 'max:100': '','required','numeric'],
            'type' => 'required|numeric|in:0,1',
            'amount_type' => 'required|numeric|in:0,1',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'amount' =>'میزان تخفیف'

        ];
    }
}
