<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        switch ($this->method()) {
            case 'POST':
                return [
                    "name"=>"required",
                    "email" =>"required|email|unique:user,email",
                    "password" => "required",
                    "type" => "required"
                ];
                break;

            case 'PUT':
                return [
                    "name"=>"required"
                ];

                break;
        }
    }

    public function messages()
    {
        return [
            "name.required" => "Name Must Be Filled",
            "email.unique" => "Email Has Been Exist",
            "email.required" => "Email Must Be Filled",
            "email.email" => "Email Format Must Be Valid",
            "password.required" => "Password Must Be Filled",
            "type.required" => "Type Must Be Filled"
        ];
    }
}
