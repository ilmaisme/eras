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
            //
            'email' => 'required|email',
            'password'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email Must Be Filled !',
            'email.email'=> 'Email Format Must Be True',
            'password.required' => 'Password Must Be Filled !'
        ];
    }
}
