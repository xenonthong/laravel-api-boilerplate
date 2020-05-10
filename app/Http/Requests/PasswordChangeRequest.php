<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current' => 'required|password:api',
            'new' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'
        ];
    }

    public function messages()
    {
        return [
            'current.required' => 'Current password field is required',
            'current.password' => 'Current password does not match our record',
            'new.required' => 'New password field is required',
            'new.regex' => 'Password does not meet our passpord policy'
        ];
    }
}
