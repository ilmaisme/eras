<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'email', 'password','alamat','type','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
 

    protected $primaryKey = 'id_user';
    public $timestamps = true;

	public function support(){
		return $this->belongsToMany('App\Client','client_support','id_support','id_client');
	}

	public function client(){
		return $this->hasOne('App\Client',"id_user");
	}

	public function cs(){
		return $this->hasMany('App\ClientSupport',"id_support");
	}

    public function sm(){
        return $this->hasMany('App\ServerMaintenance','id_support');
    }

    public function tiket(){
        return $this->hasOne('App\Tiket','id_support');
    }

    public function rk(){
        return $this->hasMany('App\RencanaKunjungan','id_support');
    }
}
