<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmDetail extends Model
{
    //
    protected $table = "sm_detail";
    protected $primaryKey = "id_sm_detail";
    public $timestamps = false;

    public function sm(){
    	return $this->belongsTo('App\ServerMaintenance','id_sm');
    }

    public function am_detail(){
    	return $this->belongsTo('App\ActionMainDetail','id_action');
    }
}
