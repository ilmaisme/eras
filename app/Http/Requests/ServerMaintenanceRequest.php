<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServerMaintenanceRequest extends Request
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
                # code...
                return [
                    //
                    'periode' => 'required',
                    'tahun' =>"required",
                    'tgl_check' => "required",
                    'id_client' => "required"
                ];
                break;
            
            case 'PUT':
                return [
                    //
                    'periode' => 'required',
                    'tahun' =>"required",
                    'tgl_check' => "required",
                    'id_client' => "required"
                ];
                break;

            default:
                # code...
                break;
        }
        
    }

    public function messages(){
        return [
            'periode.required' => 'Periode Must Be Filled',
            'tahun.required' => 'Tahun Must Be Filled',
            'tgl_check.required' => 'Tgl Check Must Be Filled',
            'client.required' => 'Client Must Be Filled',
        ];

    }
}
