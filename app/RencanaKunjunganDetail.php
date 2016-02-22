<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RencanaKunjunganDetail extends Model
{
    //

   	protected $table = 'rk_detail';
   	protected $primaryKey = 'id_rk_detail';
   	public $timestamps = false;

   	public function bugs(){
   		return $this->belongsTo('App\Bugs','id_bugs');
   	}

   	public function rk(){
   		return $this->belongsTo('App\RencanaKunjungan','id_rk');
   	}
}
