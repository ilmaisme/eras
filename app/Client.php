<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
	protected $table = 'client';
	public $timestamp = true;
	protected $primaryKey = "id_client";

	public function support(){
		return $this->belongsToMany('App\User','client_support','id_client','id_support');
	}

	public function tiket(){
		return $this->hasMany('App\Tiket','id_client');
	}

	public function user(){
		return $this->belongsTo("App\User","id_user");
	}

	public function sm(){
		return $this->hasMany('App\ServerMaintenance','id_client');
	}
}
