<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionMainRequest;
use App\ActionMain;
use App\ActionMainDetail;
use Session;

class ActionMainController extends Controller
{
    //

    public function index(){
    	parent::$_data['am'] = ActionMain::all();
    	return view("action_maintenance.am_list",parent::$_data);
    }

    public function create(){
    	return view("action_maintenance.am_add");
    }

    public function store(ActionMainRequest $req){
    	$am = new ActionMain();
    	$am->nama_action = $req->nama;
    	$am->save();

    	foreach($req->am_detail as $item){
    		$am_detail = new ActionMainDetail();
    		$am_detail->id_am = $am->id_actions;
    		$am_detail->nama = $item;
    		$am_detail->save();
    	}

    	Session::flash("success","Success Add Action Maintenance");
    	return redirect()->route('action.maintenance');
    }

    public function edit($id){
    	parent::$_data['am'] = ActionMain::find($id);
    	parent::$_data['am_detail'] = ActionMainDetail::where("id_am","=",$id)->get();

    	return view("action_maintenance.am_edit",parent::$_data);

    }

    public function update(ActionMainRequest $req,$id){
    	$am = ActionMain::find($id);
    	$am->nama_action = $req->nama;
    	$am->save();

    	$delete = ActionMainDetail::where("id_am","=",$id)->delete();

    	foreach($req->am_detail as $item){
    		$am_detail = new ActionMainDetail();
    		$am_detail->id_am = $am->id_actions;
    		$am_detail->nama = $item;
    		$am_detail->save();
    	}

    	Session::flash("success","Success Update Action Maintenance");
    	return redirect()->route('action.maintenance');
    }

    public function destroy($id){
    	$am = ActionMain::find($id);
    	$am->delete();
    	$am_detail = ActionMainDetail::where("id_am",'=',$id)->delete();
    	Session::flash("success","Success Delete Action Maintenance");
    }

    public function show($id){
    	parent::$_data['am'] = ActionMain::find($id);
    	parent::$_data['am_detail'] = ActionMainDetail::where("id_am","=",$id)->get();

    	return view("action_maintenance.am_detail",parent::$_data);
    }
}
