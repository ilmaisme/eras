<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bugs;
use App\Software;
use App\SoftwareDetail;
use App\Http\Requests\BugRequest;
use Illuminate\Support\Facades\Session;

class BugsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        parent::$_data['bugs'] = Bugs::all();
        return view("master.bugs.bugs_list",parent::$_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        parent::$_data['software'] = $this->_gen_software();
        return view("master.bugs.bugs_add",parent::$_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BugRequest $request)
    {
        //
        $bugs = new Bugs();
        $bugs->nama_bugs = $request->bugs;
        $bugs->penyelesaian = $request->penyelesaian;
        $bugs->id_software = $request->software;
        $bugs->id_modul = $request->software_detail;
        $bugs->save();

        Session::flash('success','Success insert bugs');
        return redirect()->route('bugs');
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
        parent::$_data['bugs'] = Bugs::find($id);
        return view("master.bugs.bugs_show",parent::$_data);
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
        parent::$_data['bugs'] = Bugs::find($id);
        parent::$_data['software'] = $this->_gen_software();
        parent::$_data['software_detail'] = $this->_gen_software_detail(parent::$_data['bugs']->id_software);
        return view('master.bugs.bugs_edit',parent::$_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BugRequest $request, $id)
    {
        //
        $bugs= Bugs::find($id);
        $bugs->nama_bugs = $request->bugs;
        $bugs->penyelesaian = $request->penyelesaian;
        $bugs->id_software = $request->software;
        $bugs->id_modul = $request->software_detail;
        $bugs->save();
        Session::flash('success','Success update bugs');
        return redirect()->route('bugs');
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
        $bugs = Bugs::find($id);
        $bugs->delete();

        Session::flash('success','Success delete bugs');
    }

    public function get_software_detail(Request $req){
        if($req->isMethod('get')){
            $sd = SoftwareDetail::where('id_software',$req->id_software)->get();
            $output = [];
            foreach($sd as $item){
                $output[$item->id_detail] = $item->nama_modul;
            }

            $views = view('_partials.list_software_detail')->with('sd',$output)->render();

            return response()->json(['status'=>true,'data'=>$views]);
        }else{
            return response()->json(['status'=>false,'msg'=>'method not allowed']);
        }
    }

    public function get_bugs(Request $req){
        if($req->ajax()){
            if($req->isMethod('get')){
                $bugs = Bugs::all();
                $view = view("_partials.bugs_list")->with("bugs",$bugs)->render();

                return response()->json(['status'=>true,'view'=>$view]);
            }
        }
    }

    private function _gen_software(){
        $software = Software::all();
        $output=[];
        foreach($software as $item){
            $output[$item->id_software] = $item->nama;
        }

       return $output;
    }

    private function _gen_software_detail($id){
        $software = SoftwareDetail::where("id_software",$id)->get();
        $output=[];
        foreach($software as $item){
            $output[$item->id_detail] = $item->nama_modul;
        }

       return $output;
    }
}
