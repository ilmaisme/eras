<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Tiket;
use App\ServerMaintenance;
use App\RencanaKunjungan;


class DashboardController extends Controller
{
    private $auth;

    public function __construct(Guard $auth)
    {
       $this->auth = $auth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //
        if($this->auth->user()->type =="administrator")
        {
            return view('dashboard.admin_dashboard');
        }
        elseif($this->auth->user()->type =="support")
        {
            parent::$_data['tiket_open'] = Tiket::where(['status'=>'open','id_support'=>Auth::user()->id_user])->count();
            parent::$_data['tiket_process'] = Tiket::where(['status'=>'process','id_support'=>Auth::user()->id_user])->count();
            parent::$_data['tiket_finish'] = Tiket::where(['status'=>'finish','id_support'=>Auth::user()->id_user])->count();
            parent::$_data['tiket_cancel'] = Tiket::where(['status'=>'cancelled','id_support'=>Auth::user()->id_user])->count();

            parent::$_data['sm_waiting'] = ServerMaintenance::where(['status'=>'waiting','id_support'=>Auth::user()->id_user])->count();
            parent::$_data['sm_approved'] = ServerMaintenance::where(['status'=>'approved','id_support'=>Auth::user()->id_user])->count();


            parent::$_data['rk_waiting'] = RencanaKunjungan::where(['status'=>'waiting','id_support'=>Auth::user()->id_user])->count();
            parent::$_data['rk_approved'] = RencanaKunjungan::where(['status'=>'approved','id_support'=>Auth::user()->id_user])->count();

            return view('dashboard.support_dashboard',parent::$_data);
        }
        elseif($this->auth->user()->type =="pm")
        {
            parent::$_data['tiket_open'] = Tiket::where('status','=','open')->count();
            parent::$_data['tiket_process'] = Tiket::where('status','=','process')->count();
            parent::$_data['tiket_finish'] = Tiket::where('status','=','finish')->count();
            parent::$_data['tiket_cancel'] = Tiket::where('status','=','cancelled')->count();

            parent::$_data['sm_waiting'] = ServerMaintenance::where('status','=','waiting')->count();
            parent::$_data['sm_approved'] = ServerMaintenance::where('status','=','approved')->count();


            parent::$_data['rk_waiting'] = RencanaKunjungan::where('status','=','waiting')->count();
            parent::$_data['rk_approved'] = RencanaKunjungan::where('status','=','approved')->count();

            return view('dashboard.pm_dashboard',parent::$_data);
        }
        elseif($this->auth->user()->type =="client")
        {
            return view('dashboard.client_dashboard');
        }

    }

}
