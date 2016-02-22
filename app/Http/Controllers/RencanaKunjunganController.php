<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tiket;
use App\Client;
use App\RencanaKunjungan;
use App\RencanaKunjunganDetail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RencanaKunjunganRequest;

use Session;

class RencanaKunjunganController extends Controller
{
    //

    public function index(){
    	
    	
        if(Auth::user()->type == 'support'){
            parent::$_data['rk'] = RencanaKunjungan::where("id_support",'=',Auth::user()->id_user)->get();
            $view = "rencana_kunjungan_list";
        }elseif(Auth::user()->type== 'pm'){
            parent::$_data['rk'] = RencanaKunjungan::all();
            $view = "rencana_kunjungan_list_pm";
        }

        return view("rencana_kunjungan.".$view,parent::$_data);
    	
    }

    public function create($id_tiket){
        parent::$_data['tiket'] = Tiket::where("id_tiket",'=',$id_tiket)->first();
        parent::$_data['id_tiket'] = $id_tiket;
    	return view("rencana_kunjungan.rencana_kunjungan_add",parent::$_data);
    }

    public function store(RencanaKunjunganRequest $req){
        $rk = new RencanaKunjungan();
        $rk->tgl_kunjungan = $req->tgl_kunjungan;
        $rk->jam_berangkat = $req->jam_berangkat;
        $rk->jam_pulang = $req->jam_pulang;
        $rk->aktifitas = $req->aktifitas;
        $rk->tipe = $req->tipe_kunjungan;
        $rk->id_support = Auth::user()->id_user;
        $rk->id_tiket = $req->id_tiket;
        $rk->status = "waiting";
        $rk->save();

        foreach($req->bugs as $item){
            $rkd = new RencanaKunjunganDetail();
            $rkd->id_bugs = $item;
            $rkd->id_rk = $rk->id_rk;
            $rkd->save();
        }

        $tiket = Tiket::find($req->id_tiket);
        $tiket->status = "process";
        $tiket->save();

        Session::flash("success","Success add Rencana Kunjungan");
        return redirect()->route('rencana.kunjungan');

    }

    public function edit($id){

        parent::$_data['rk'] = RencanaKunjungan::find($id);
        parent::$_data['rk_detail'] = RencanaKunjunganDetail::where("id_rk","=",$id)->get();
        return view("rencana_kunjungan.rencana_kunjungan_edit",parent::$_data);
    }

    public function update(RencanaKunjunganRequest $req,$id){
        $rk = RencanaKunjungan::find($id);
        $rk->tgl_kunjungan = $req->tgl_kunjungan;
        $rk->jam_berangkat = $req->jam_berangkat;
        $rk->jam_pulang = $req->jam_pulang;
        $rk->aktifitas = $req->aktifitas;
        $rk->tipe = $req->tipe_kunjungan;
        $rk->save();

        $delete = RencanaKunjunganDetail::where("id_rk","=",$id);
        $delete->delete();

        foreach($req->bugs as $item){
            $rkd = new RencanaKunjunganDetail();
            $rkd->id_bugs = $item;
            $rkd->id_rk = $rk->id_rk;
            $rkd->save();
        }

        Session::flash("success","Success Edit Rencana Kunjungan");
        return redirect()->route('rencana.kunjungan');
    }

    public function show($id){
        if(Auth::user()->type == "support"){
            $view = "rencana_kunjungan_detail";
        }elseif(Auth::user()->type == "pm"){
            $view = "rencana_kunjungan_detail_pm";
        }
        parent::$_data['rk'] = RencanaKunjungan::find($id);
        parent::$_data['rk_detail'] = RencanaKunjunganDetail::where("id_rk","=",$id)->get();
        return view("rencana_kunjungan.".$view,parent::$_data);
    }

    public function update_approve(Request $req){
        if($req->ajax()){
            $tiket = RencanaKunjungan::find($req->id_rk);
            $tiket->status = "approved";
            $tiket->save();
            return response()->json(["status"=>true]);            
        }

        return response()->json(["status"=>false]);
    }

    public function rk_report(){
        parent::$_data['client']  = $this->_client();
        return view("report.rk_report",parent::$_data);
    }

    public function rk_post(Request $req){
        if($req->type == "periode_client"){
            $range = explode('to', trim($req->range));
            $client = $req->client;
            $data = RencanaKunjungan::whereHas('tiket',function($q) use($req,$range) {
                $q->where('id_client','=',$req->client);
                $q->whereBetween('rencana_kunjungan.tgl_kunjungan',[$range[0].' 00:00:01',$range[1]. ' 23:59:59']);
            })->get();
        }else{
            $range = explode('to', trim($req->range));
            $data = RencanaKunjungan::whereHas('tiket',function($q) use($req,$range) {
                $q->whereBetween('rencana_kunjungan.tgl_kunjungan',[$range[0].' 00:00:01',$range[1]. ' 23:59:59']);
            })->get();
        }
        
        parent::$_data['results'] = $data;

        return view('report.result_rk',parent::$_data);
    }

    private function _client(){
        $client = Client::all();
        $res = [];
        foreach ($client as $key => $value) {
            # code...
            $res[$value['id_client']] = $value['nama_pt'];
        }

        return $res;
    }
}
