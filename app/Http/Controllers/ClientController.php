<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ClientRequest;
use App\Http\Controllers\Controller;
use App\ClientSupport;
use App\Client;
use App\User;
use Session;
use Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        parent::$_data['client'] = Client::all();
        return view("master.client.client_list",parent::$_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        parent::$_data['support'] = $this->_gen_support();
        return view("master.client.client_add",parent::$_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        //
	    $user = new User();
	    $user->email = $request->email;
	    $user->nama = $request->name_pt;
		$user->password = Hash::make($request->password);
	    $user->type = "client";
	    $user->status = "active";
	    $user->save();

	    $client = new Client();
	    $client->nama_pt = $request->name_pt;
	    $client->pic = $request->pic;
	    $client->alamat = $request->address;
	    $client->no_telepon = $request->phone;
		$client->id_user = $user->id_user;
	    $client->lat = $request->lat;
	    $client->long = $request->long;
	    $client->save();

	    foreach($request->support as $item){
		    $cs = new ClientSupport();
		    $cs->id_client = $client->id_client;
		    $cs->id_support = $item;
		    $cs->save();
	    }

	    Session::flash("success","Success add client");
	    return redirect()->route('client');
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
	    parent::$_data['client'] = Client::find($id);
	    parent::$_data['user'] = User::find(parent::$_data['client']->id_user);

	    return view("master.client.client_show",parent::$_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
	    parent::$_data['client'] = Client::find($id);
	    parent::$_data['user'] = User::find(parent::$_data['client']->id_user);
	    parent::$_data['support'] = $this->_gen_support();
	    parent::$_data['clientsupport'] = ClientSupport::where("id_client",$id)->get();
	    return view("master.client.client_edit",parent::$_data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        //

	    $client = Client::find($id);
	    $client->nama_pt = $request->name_pt;
	    $client->pic = $request->pic;
	    $client->alamat = $request->address;
	    $client->no_telepon = $request->phone;
	    $client->save();

	    $cs = ClientSupport::where("id_client",$id);
	    $cs->delete();

	    foreach($request->support as $item){
		    $cs = new ClientSupport();
		    $cs->id_client = $client->id_client;
		    $cs->id_support = $item;
		    $cs->save();
	    }

	    Session::flash("success","Success Edit client");
	    return redirect()->route('client');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
	    $client = Client::find($id);
		$cs = ClientSupport::where('id_client',$id)->delete();
	    $user = User::find($client->id_user)->delete();
	    $client->delete();
	    Session::flash("success","Success Delete Client");
    }

    public function client_report(){
        parent::$_data['client'] = Client::all();
        return view("report.client_report",parent::$_data);
    }

    private function _gen_support(){
        $support = User::where("type","support")->get();
        $output= [];
        foreach($support as $item){
            $output[$item->id_user] = $item->nama;
        }

        return $output;
    }
}
