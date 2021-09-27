<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email:rfc,dns',
            'zipcode' => 'required|string|regex:/^[0-9]{7}$/i',
            'address' => 'required|string|max:2000',
            'phone_number' => ['required', 'string', 'regex:/^0([0-9]-[0-9]{4}|[0-9]{2}-[0-9]{3}|[0-9]{2}-[0-9]{4}|[0-9]{3}-[0-9]{2}|[0-9]{4}-[0-9])-[0-9]{4}$/i'],
        ];
    }
}
