<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginFormRequest extends Request
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
            'password'         => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'Заполните все поля.',
            'min'  => ':attribute must be at least :min characters in length.',
            'email' => 'Please type valid email address.',
        ];
    }
}
