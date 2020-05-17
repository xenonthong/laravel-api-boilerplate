<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Regex;

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
            'name' => 'required|max:150',
            'username' => 'required|unique:users,username|alpha_dash|min:5',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile|regex:' . Regex::MOBILE,
            'password' => 'required|min:8|regex:' . Regex::PASSWORD
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password does not meet our password policy'
        ];
    }
}
