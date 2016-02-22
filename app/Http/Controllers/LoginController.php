<?php

namespace App\Http\Controllers;

use Session;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Contracts\Auth\Guard;

class LoginController extends Controller
{
    private $auth;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        //Do your magic here
    }

    public function index()
    {
        return view('template.master_login');
    }

    public function login(LoginFormRequest $req)
    {
        $remember = $req->remember;
        if($remember =='remember')
        {
            $remember= true;
        }
        else {
            $remember = false;
        }


        $params = [
                'email' => $req->email,
                'password' => $req->password
        ];

        if($this->auth->attempt($params,$remember))
        {
            return redirect('dashboard');
        }
        else
        {
            Session::flash('error','Username / Password is Wrong');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        $this->auth->logout();
        return redirect('/');
    }
    
}
