<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'id' => ['required', 'numeric', 'integer', 'min:1', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'username' => ['required', 'string', 'alpha_num', 'min:6', 'unique:users'],
            'password' => ['required', Password::min(6)],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'firstname' => 'first name',
            'lastname' => 'last name',
            'id' => 'student ID',
        ];
    }
}
