<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use Hash;
use Session;
use Validator;
use Illuminate\Routing\Route;
use Illuminate\Contracts\Auth\Guard;
use Erasoft\Libraries\CustomLib;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        parent::$_data['user'] = User::all();
        return view("master.user.user_list",parent::$_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("master.user.user_add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        try {
            $user = new User();
            $user->nama = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = $request->type;
            $user->status = "active";
            $user->save();

            Session::flash("success","Success Insert User");
            return redirect()->route('user');
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
        parent::$_data['user'] = User::find($id);
        return view("master.user.user_profile",parent::$_data);
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
        parent::$_data['user'] = User::find($id);
        if(parent::$_data['user']->type == "client"){
            parent::$_data['type'] = ["pm"=>"Project Manager","support"=>"Support","client"=>"Client"];
        }else{
            parent::$_data['type'] = \Erasoft\Libraries\CustomLib::gen_type();
        }
        return view('master.user.user_edit',parent::$_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        if($request->email != $request->em){
            $check = User::where('email','=',$request->email)->count();
            if($check > 0 ){
                Session::flash('error','Email telah terdaftar, gunakan email lain');
                return redirect()->back()->withInput();
            }
        }

        try {
            $user = User::find($id);
            $user->nama = $request->name;
            $user->email = $request->email;
            $user->type = $request->type;
            $user->save();

            Session::flash("success","Success Update User");
            return redirect()->route('user');            
            
        } catch (Exception $e) {
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
            $user = User::find($id);
            $user->delete();

            Session::flash("success","Success Delete User");

        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function profile(Guard $auth)
    {
        $user = $auth->user();
        parent::$_data['user'] = $user;
        return view('_partials.profile',parent::$_data);
    }

    public function getuser(Guard $auth)
    {
         $user = $auth->user();
         return response()->json($user);
    }

    public function update_profile(Guard $auth,Request $req)
    {
        $results = [];

        $data = [
            'name' => $req->name,
            
        ];

        $rules = [
            'name'=>'required',

        ];

        if($req->password != "") {
            $data['password'] = $req->password;
            $data['password_confirmation'] = $req->password_confirmation;
            $rules['password'] = "required|confirmed";
            $rules['password_confirmation'] = "required";
        }
       
       
        $validator = Validator::make($data,$rules);
        if($validator->fails())
        {
            $errors = $validator->errors();
            $error_message = "";
            $error_message .= "<ul>";

            foreach($errors->all() as $val) {
                $error_message .= "<li>".$val."</li>";
            }

            $error_message.="</ul>";

            $results['message'] =  CustomLib::generate_notification($error_message,"error");
            $results['status'] = false;

            return response()->json($results);
        }

        $user = User::find($req->id_user);
        $user->nama = $req->name;
        if($req->password !="")
            $user->password = Hash::make($req->password);
        $user->save();

        $results['message'] = CustomLib::generate_notification("Data Has Been Saved","success");
        $results['status'] = true;

        return response()->json($results); 

    }

    public function support_report(){
        parent::$_data['user'] = User::where("type","=","support")->get();
        return view("report.user_report",parent::$_data);

    }

}
