<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BugRequest extends Request
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
				    'bugs' => 'required',
				    'penyelesaian' => 'required',
				    'software' => 'required',
				    'software_detail' => 'required'
			    ];
		        break;
		    case 'PUT':
			    return [
				    //
				    'bugs' => 'required',
				    'penyelesaian' => 'required',
				    'software' => 'required',
				    'software_detail' => 'required'
			    ];
		        break;
	    }

    }

    public function messages(){
        return [
            'bugs.required' => 'Nama Bugs Must Be Filled',
            'penyelesaian.required' => 'Penyelesaian Must Be Filled',
            'software.required' => 'Software Must Be Filled',
            'software_detail.required' => 'Modul Must Be Filled'
        ];
    }
}
