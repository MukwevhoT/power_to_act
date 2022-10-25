<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|',
            'first_name' => 'required|string',
            'surname' => 'required|string',
            'phone_number' => 'nullable',
            'location' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:8'
        ];
    }
}
