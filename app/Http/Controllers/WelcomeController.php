<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Erasoft\Libraries\CustomLib;

class WelcomeController extends Controller {

   public function test()
   {
      echo "testes";
   }

   public function show_login()
   {
   	  return view('login');
   }

   public function login(LoginFormRequest $req)
   {
   	 	return \Redirect::route('user/logins')->with('message','Thx for login');
   }

   public function hay(CustomLib $cust)
   {
      echo $cust->get();
   }





}
 ?>
