<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    //
	protected $table = 'tiket';
	public $timestamp = true;
	protected $primaryKey = "id_tiket";

	public function client(){
		return $this->belongsTo("App\Client",'id_client');
	}

	public function rk(){
		return $this->hasOne('App\RencanaKunjungan','id_tiket');
	}

	public function support(){
		return $this->belongsTo('App\User','id_support');
	}
}
