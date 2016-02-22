<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ServerMaintenance;
use App\SmDetail;
use App\Http\Requests\ServerMaintenanceRequest;
use Illuminate\Support\Facades\Auth;
use App\Client;
use App\ActionMain;
use App\ActionMainDetail;
use Session;

class ServerMaintenanceController extends Controller
{
    //
	public function index(){
		
		if(Auth::user()->type == 'support'){
			parent::$_data['sm'] = ServerMaintenance::where("id_support",'=',Auth::user()->id_user)->get();
			$view = "sm_list";
		}elseif(Auth::user()->type== 'pm'){
			parent::$_data['sm'] = ServerMaintenance::all();
			$view = "sm_list_pm";
		}

		return view("server_maintenance.".$view,parent::$_data);
	}

	public function create(){
		parent::$_data['client'] = $this->_client();
		parent::$_data['tahun'] = $this->_tahun();
		parent::$_data['bulan'] = $this->_bulan();	
		parent::$_data['service'] = $this->_service();
	
		return view("server_maintenance.sm_add",parent::$_data);
	}

	public function store(ServerMaintenanceRequest $req){

		$check = ServerMaintenance::where(['periode'=>$req->periode,'tahun'=>$req->tahun,'id_client'=>$req->id_client])->count();
		
		if($check > 0 ){
			Session::flash("error","Data Bulan: <b>".\Erasoft\Libraries\CustomLib::gen_bulan($req->periode)."</b> Tahun: <b>".$req->tahun."</b> Sudah Ada");
			return redirect()->route('server.maintenance.create');
		}

		$sm = new ServerMaintenance();
		$sm->periode = $req->periode;
		$sm->tahun = $req->tahun;
		$sm->tgl_check = $req->tgl_check;
		$sm->id_support = Auth::user()->id_user;
		$sm->id_client = $req->id_client;
		$sm->status = "waiting";
		$sm->save();

		foreach($req->checked as $key => $item){
			$sm_d = new SmDetail();
			$sm_d->id_sm = $sm->id_sm;
			$sm_d->id_action = $item;
			$sm_d->keterangan = $req->keterangan[$item];
			$sm_d->save();
		}

		Session::flash("success","Success Add Server Maintenance");
		return redirect()->route('server.maintenance');
	}

	public function edit($id){
		parent::$_data['client'] = $this->_client();
		parent::$_data['tahun'] = $this->_tahun();
		parent::$_data['bulan'] = $this->_bulan();	
		parent::$_data['service'] = $this->_service();
		parent::$_data['sm'] = ServerMaintenance::find($id);
		parent::$_data['sm_detail'] = $this->_sm_detail($id);

		return view("server_maintenance.sm_edit",parent::$_data);
	}

	public function update(ServerMaintenanceRequest $req,$id){
		$sm = ServerMaintenance::find($id);
		$sm->periode = $req->periode;
		$sm->tahun = $req->tahun;
		$sm->tgl_check = $req->tgl_check;
		$sm->id_client = $req->id_client;
		$sm->save();

		$delete = SmDetail::where("id_sm",'=',$id)->delete();

		foreach($req->checked as $key => $item){
			$sm_d = new SmDetail();
			$sm_d->id_sm = $sm->id_sm;
			$sm_d->id_action = $item;
			$sm_d->keterangan = $req->keterangan[$item];
			$sm_d->save();
		}

		Session::flash("success","Success Edit Server Maintenance");
		return redirect()->route('server.maintenance');
	}

	public function destroy($id){

	}

	public function show($id){
		parent::$_data['sm'] = ServerMaintenance::find($id);
		parent::$_data['sm_detail'] = SmDetail::where("id_sm",'=',$id)->get();

		if(Auth::user()->type == "support"){
			$view = 'sm_detail';
		}elseif(Auth::user()->type == "pm"){
			$view = 'sm_detail_pm';
		}

		return view("server_maintenance.".$view,parent::$_data);
	}

	public function update_approve(Request $req){
        if($req->ajax()){
            $tiket = ServerMaintenance::find($req->id_sm);
            $tiket->status = "approved";
            $tiket->save();
            return response()->json(["status"=>true]);            
        }

        return response()->json(["status"=>false]);
    }

    public function sm_report(){
        parent::$_data['client']  = $this->_client();
        parent::$_data['tahun']  = $this->_tahun();
        return view("report.sm_report",parent::$_data);
    }

    public function sm_post(Request $req){
        if($req->type == "periode_client"){
            $where = ['tahun'=>$req->tahun,'id_client'=>$req->client];
            $data = ServerMaintenance::where($where)->get();
        }else{
             
            $data = ServerMaintenance::where("tahun","=",$req->tahun)->get();
        }
        
        parent::$_data['results'] = $data;

        return view('report.result_sm',parent::$_data);
    }

	private function _tahun (){
		$tahun=[];
		for($i=2016; $i<2020; $i++){
			$tahun[$i]=$i;
		}

		return $tahun;
	}

	private function _bulan(){
		$bulan = [];
		$bulan[1] = "Januari";
		$bulan[2] = "Februari";
		$bulan[3] = "Maret";
		$bulan[4] = "April";
		$bulan[5] = "Mei";
		$bulan[6] = "Juni";
		$bulan[7] = "Juli";
		$bulan[8] = "Agustus";
		$bulan[9] = "September";
		$bulan[10] = "Oktober";
		$bulan[11] = "November";
		$bulan[12] = "Desember";

		return $bulan;
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

	private function _service(){
		$service = ActionMain::all();
		$res = [];

		foreach($service as $item){
			$detail_service = ActionMainDetail::where("id_am","=",$item->id_actions)->get();
			$det = [];
			foreach($detail_service as $val) {
				$det[$val->id_am_detail] = $val->nama;
			}

			$res[$item->nama_action] = $det;
			
		}

		return $res;
		
	}

	private function _sm_detail($id){
		$sm_d = SmDetail::where("id_sm","=",$id)->get();
		$res = [];
		foreach($sm_d as $item){
			$res[$item->id_action] = $item->keterangan;
		}

		return $res;
	}

	
}
