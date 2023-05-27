<?php

namespace App\Http\Requests\Customer\Profile;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => 'required|max:2000|min:2|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,\/;&؟? ]+$/u',
            'subject' => 'required|max:100|min:1|regex:/^[ا-یa-zA-Z۰-۹0-9ء-ي.,><\/;\n\r& ]+$/u',
            'category_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:ticket_categories,id',
            'priority_id' => 'required|min:1|regex:/^[0-9]+$/u|exists:ticket_priorities,id',
            'file' => 'mimes:png,jpeg,jpg,gif',



        ];
    }
}
