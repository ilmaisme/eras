<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerMaintenance extends Model
{
    //
    protected $table = "server_maintenance";
    protected $primaryKey = "id_sm";

    public function detail_sm(){
    	return $this->hasMany('App\SmDetail','id_sm');
    }

    public function client(){
    	return $this->belongsTo('App\Client','id_client');
    }

    public function support(){
    	return $this->belongsTo('App\User','id_support');
    }
}
