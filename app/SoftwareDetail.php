<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoftwareDetail extends Model
{
    //
    protected $table = 'software_detail';
    protected $primaryKey = 'id_detail';
    public $timestamps = false;
    
    public function software()
    {
    	return $this->belongsTo('App\Software','id_software');
    }

    public function bugs(){
        return $this->hasMany('App\Bugs');
    }


}
