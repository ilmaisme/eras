<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RencanaKunjunganRequest extends Request
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
                    //
                    'tgl_kunjungan' => 'required',
                    'jam_berangkat' => 'required',
                    'jam_pulang' => 'required',
                    'tipe_kunjungan' => 'required',
                    'aktifitas' => 'required'
                ];
                break;

            case 'PUT' :
                return [
                    //
                    'tgl_kunjungan' => 'required',
                    'jam_berangkat' => 'required',
                    'jam_pulang' => 'required',
                    'tipe_kunjungan' => 'required',
                    'aktifitas' => 'required'
                ];
                break;
            
            default:
                # code...
                break;
        }
        
    }

    public function messages(){
        return [
            'tgl_kunjungan.required' => 'Tanggal Kunjungan Must Be Filled',
            'jam_berangkat.required' => 'Jam Berangkat Must Be Filled',
            'jam_pulang.required' => 'Jam Pulang Must Be Filled',
            'tipe_kunjungan.required' => 'Tipe Kunjunga Must Be Filled',
            'aktifitas.required' => 'JAktifitas Must Be Filled'
        ];
    }
}
