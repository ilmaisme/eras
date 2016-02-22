<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RencanaKunjungan extends Model
{
    //
    protected $table = "rencana_kunjungan";
    public $timestamp = true;
    protected $primaryKey = "id_rk";

    public function tiket(){
    	return $this->belongsTo('App\Tiket','id_tiket');
    }

    public function rk_detail(){
    	return $this->hasMany('App\RencanaKunjunganDetail','id_rk');
    }

    public function support(){
        return $this->belongsTo('App\User','id_support');
    }
}
