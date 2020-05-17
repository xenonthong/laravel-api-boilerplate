<?php

namespace App\Http\Requests;

use App\Enums\Regex;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
                return [
                    'name' => 'required|max:150',
                    'username' => 'required|unique:users,username|alpha_dash|min:5',
                    'email' => 'required|email|unique:users,email',
                    'mobile' => 'required|unique:users,mobile',
                    'address' => 'required|max:250'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:150',
                    'username' => 'required|alpha_dash|min:5|unique:users,username,' . Auth::user()->id .',id',
                    'email' => 'required|email|unique:users,email,' . Auth::user()->id .',id',
                    'mobile' => 'required|regex:' . Regex::MOBILE . '|unique:users,mobile,' . Auth::user()->id .',id',
                    'address' => 'required|max:250',
                ];
            default:
                return [];
        }
    }
}
