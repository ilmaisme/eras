<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Software;
use App\SoftwareDetail;
use League\Flysystem\Exception;
use Session;
use App\Http\Requests\SoftwareRequest;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        parent::$_data['software'] = Software::all();
        return view("master.software.software_list",parent::$_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("master.software.software_add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SoftwareRequest $request)
    {
        //
        try {
            $software = Software::create();
            $software->nama = $request->name;
            $software->versi = $request->version;
            $software->save();

            foreach($request->modul_name as $item){
                $software_detail = new SoftwareDetail();
                $software_detail->id_software = $software->id_software;
                $software_detail->nama_modul = $item;
                $software_detail->save();
            }

            Session::flash("success","Success add software");
            return redirect()->route('software');

        } catch (Exception $e) {
            print $e->getMessage();
        }
        

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
        try {
            parent::$_data['software'] = Software::find($id);
            parent::$_data['software_detail'] = SoftwareDetail::where('id_software',parent::$_data['software']->id_software)->get();
            return view("master.software.software_detail",parent::$_data);
        } catch(Exception $e){
            print $e->getMessage();
        }
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
        try {
            parent::$_data['software'] = Software::find($id);
            parent::$_data['software_detail'] = SoftwareDetail::where('id_software',parent::$_data['software']->id_software)->get();
            return view("master.software.software_edit", parent::$_data);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SoftwareRequest $request, $id)
    {
        //
        try {
            $software = Software::find($id);
            $software->nama = $request->name;
            $software->versi = $request->version;
            $software->save();

            $software_detail  = SoftwareDetail::where('id_software',$id);
            $software_detail->delete();

            foreach($request->modul_name as $item) {
                $save_detail = new SoftwareDetail();
                $save_detail->id_software = $id;
                $save_detail->nama_modul = $item;
                $save_detail->save();
            }

            Session::flash("success","Success Edit Software");
            return redirect()->route('software');
        } catch (Exception $e){
            print $e->getMessage();
        }
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
        try {
            $software = Software::find($id);
            $software->delete();
            $software_detail = SoftwareDetail::where('id_softare',$id)->delete();

            Session::flash("success","Success Delete Software");

        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}
