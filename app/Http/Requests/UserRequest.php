<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required|min:2|max:255|unique:users',
            'email' => 'nullable|min:2|max:255|email|unique:users',
            'password' => 'required|min:6|max:255',
            'sites' => 'nullable|array'
        ];

        return $rules;
    }
}
