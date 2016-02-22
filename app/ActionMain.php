<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionMain extends Model
{
    //
    protected $table = "actions_maintenance";
    protected $primaryKey = "id_actions";
    public $timestamps = false;

    public function detail(){
    	return $this->hasMany('App\ActionMainDetail','id_am');
    }
}
