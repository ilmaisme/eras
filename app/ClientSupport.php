<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSupport extends Model
{
    //
	protected $table = "client_support";
	protected $primaryKey = "id_cs";
	public $timestamp = false;

	public function support(){
		return $this->belongsTo('App\User','id_support');
	}
}
