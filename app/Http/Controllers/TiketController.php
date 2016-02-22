<?php

namespace App\Http\Controllers;
use App\Tiket;
use App\Http\Requests\TiketRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Contracts\Auth\Guard;
use App\ClientSupport;
use Illuminate\Http\Request;
use App\Client;


class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->type == "pm"){
            $tiket = Tiket::all();
            $view = "tiket.tiket_list_pm";
        }elseif(Auth::user()->type == "client"){
            $client_id = Auth::user()->client->id_client;
            $tiket = Tiket::where("id_client","=",$client_id)->get();
            $view = "tiket.tiket_list";
        }elseif(Auth::user()->type == "support"){
            $tiket = Tiket::where("id_support","=",Auth::user()->id_user)->get();
            $view = "tiket.tiket_list_support";
        }

        parent::$_data['tiket'] = $tiket;
        return view($view,parent::$_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("tiket.tiket_add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TiketRequest $request)
    {
        //
        $tiket = new Tiket();
        $tiket->masalah = $request->masalah;
        $tiket->status = 'open';
        $tiket->id_client = Auth::user()->client->id_client;
        $tiket->save();

        Session::flash("success","Success add tiket");
        return redirect()->route('tiket');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        parent::$_data['tiket'] = Tiket::find($id);

        if(Auth::user()->type == "pm"){
            parent::$_data['support'] = $this->_gen_support(parent::$_data['tiket']->id_client);
            $view = "tiket.tiket_show_pm";
        }elseif(Auth::user()->type== "client"){
            $view = "tiket.tiket_show";
        }elseif(Auth::user()->type == "support"){
            $view = "tiket.tiket_show_support";
        }

        return view($view,parent::$_data);
    }

    public function update_support(Request $req){
        if($req->ajax()){
            $tiket = Tiket::find($req->id_tiket);
            $tiket->id_support = $req->id_support;
            $tiket->save();
            
            return response()->json(["status"=>true]);
        }

        return response()->json(["status"=>false]);
    }

    public function update_batal(Request $req){
        if($req->ajax()){
            $tiket = Tiket::find($req->id_tiket);
            $tiket->status = "cancelled";
            $tiket->save();
            return response()->json(["status"=>true]);            
        }

        return response()->json(["status"=>false]);
    }

    public function update_finish(Request $req){
        if($req->ajax()){
            $tiket = Tiket::find($req->id_tiket);
            $tiket->status = "finish";
            $tiket->save();
            return response()->json(["status"=>true]);            
        }

        return response()->json(["status"=>false]);
    }

    public function logoutstanding_report(){
        parent::$_data['client']  = $this->_client();
        return view("report.logoutstanding_report",parent::$_data);
    }

    public function maintenanceprogress_report(){
        parent::$_data['client']  = $this->_client();
        return view("report.maintenanceprogress_report",parent::$_data);
    }

    public function mp_post(Request $req){
        if($req->type == "periode_client"){
            $range = explode('to', trim($req->range));
            $client = $req->client;
            $data = Tiket::whereHas('rk',function($q) use($req,$range) {
                $q->where('tiket.id_client','=',$req->client);
                $q->where('tiket.status','=',"finish");
                $q->whereBetween('rencana_kunjungan.created_at',[$range[0].' 00:00:01',$range[1]. ' 23:59:59']);
            })->get();
        }else{
            $range = explode('to', trim($req->range));
            $data = Tiket::where('tiket.status','=','finish')->whereHas('rk',function($q) use($req,$range) {
                $q->whereBetween('rencana_kunjungan.created_at',[$range[0].' 00:00:01',$range[1]. ' 23:59:59']);
            })->get();
        }
        
        parent::$_data['results'] = $data;

        return view('report.result_mp',parent::$_data);

    }

    public function ls_post(Request $req){
        if($req->type == "periode_client"){
            $range = explode('to', trim($req->range));
            $client = $req->client;
            $data = Tiket::whereHas('rk',function($q) use($req,$range) {
                $q->where('tiket.id_client','=',$req->client);
                $q->where('tiket.status','=',"process");
                $q->whereBetween('rencana_kunjungan.created_at',[$range[0].' 00:00:01',$range[1]. ' 23:59:59']);
            })->get();
        }else{
            $range = explode('to', trim($req->range));
            $data = Tiket::where('tiket.status','=','process')->whereHas('rk',function($q) use($req,$range) {
                $q->whereBetween('rencana_kunjungan.created_at',[$range[0].' 00:00:01',$range[1]. ' 23:59:59']);
            })->get();
        }
        
        parent::$_data['results'] = $data;

        return view('report.result_ls',parent::$_data);

    }

    private function _gen_support($id_client){
        $support = ClientSupport::where("id_client","=",$id_client)->get();
        $res = [];
        foreach($support as $c){
            $res[$c->id_support] = $c->support->nama;
        }

        return $res;
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