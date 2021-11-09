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
            'email' => 'required|email',
            'password' => 'required|min:8|max:255',
            'name' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be valid.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password can be max 255 characters.',
            'name.required' => 'The name is required.',
            'name.max' => 'The name can be max 255 characters.'
        ];
    }
}
