<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    //
    protected $table = 'software';
    protected $primaryKey = 'id_software';
    public $timestamps = false;

    public function software_detail()
    {
    	return $this->hasMany('App\SoftwareDetail','id_software');
    }

    public function bugs(){
        return $this->hasMany("App\Bugs",'id_software');
    }
}
