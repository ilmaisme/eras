<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClientRequest extends Request
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

	    switch($this->method()){
		    case 'POST':
			    return [
				    //
				    'name_pt' => 'required',
				    'pic' => 'required',
				    'phone' => 'required|numeric',
				    'address' => 'required',
				    'email' => 'required|email|unique:user,email',
				    'password' => 'required',
				    'long' => 'required',
				    'lat' => 'required'
			    ];
		        break;

		    case 'PUT':
			    return [
				    //
				    'name_pt' => 'required',
				    'pic' => 'required',
				    'phone' => 'required|numeric',
				    'address' => 'required'
			    ];
		        break;
	    }

    }

    public function messages(){
        return [
            'name_pt.required' => 'Nama PT Must Be Filled',
            'pic.required' => 'PIC Must Be Filled',
            'phone.required' => 'Phone Must Be Filled',
            'address.required' => 'Address Must Be Filled',
            'email.required' => 'Email Must Be Filled',
	        'email.email' => 'Email Format Must Be Valid',
            'email.unique' => 'Email Already Exists',
            'password.required' => 'Password Must Be Filled',
	        'long.required' => 'Longitude Must Be Filled',
	        'lat.required' => "Latitude Must Be Filled"
        ];
    }
}
