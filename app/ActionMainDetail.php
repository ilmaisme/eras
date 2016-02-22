<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionMainDetail extends Model
{
    //

    protected $table = "am_detail";
    protected $primaryKey = "id_am_detail";
    public $timestamps = false;

    public function am(){
    	return $this->belongsTo('App\ActionMain','id_am');
    }

    public function sm_detail(){
    	return $this->hasMany('App\SmDetail','id_action');
    }
}
