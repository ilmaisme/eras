<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Login Route
Route::get('/',['uses'=>'LoginController@index','middleware'=>'guest','as'=>'login']);
Route::post('app.login','LoginController@login');
Route::get('logout',['uses'=>'LoginController@logout','as'=>'logout']);


Route::group(['middleware'=>'auth'],function(){

   //USER
   Route::get('dashboard',['uses'=>'DashboardController@index','as'=>'dashboard']);
   Route::get('profile',['uses'=>'UserController@profile','as'=>'user.profile']);
   
   //user
   Route::get('user',['uses'=>'UserController@index','as'=>'user']);
   Route::get('user/show/{id}',['uses'=>'UserController@show','as'=>'user.show']);
   Route::get('user/create',['uses'=>'UserController@create','as'=>'user.create']);
   Route::get('user/edit/{id}',['uses'=>'UserController@edit','as'=>'user.edit']);
   Route::post('user/store',['uses'=>'UserController@store','as'=>'user.store']);
   Route::put('user/update/{id}',['uses'=>'UserController@update','as'=>'user.update']);
   Route::delete('user/delete/{id}',['uses'=>'UserController@destroy','as'=>'user.delete']);

   //API USER
   Route::get('get.user',['uses'=>'UserController@getuser','as'=>'get.user']);
   Route::put('update.user',['uses'=>'UserController@update_profile','as'=>'update.profile']);

   
   //client
   Route::get('client',['uses'=>'ClientController@index','as'=>'client']);
   Route::get('client/show/{id}',['uses'=>'ClientController@show','as'=>'client.show']);
   Route::get('client/create',['uses'=>'ClientController@create','as'=>'client.create']);
   Route::get('client/edit/{id}',['uses'=>'ClientController@edit','as'=>'client.edit']);
   Route::post('client/store',['uses'=>'ClientController@store','as'=>'client.store']);
   Route::put('client/update/{id}',['uses'=>'ClientController@update','as'=>'client.update']);
   Route::delete('client/delete/{id}',['uses'=>'ClientController@destroy','as'=>'client.delete']);

   

   //Software
   Route::get('software',['uses'=>'SoftwareController@index','as'=>'software']);
   Route::get('software/show/{id}',['uses'=>'SoftwareController@show','as'=>'software.show']);
   Route::get('software/create',['uses'=>'SoftwareController@create','as'=>'software.create']);
   Route::get('software/edit/{id}',['uses'=>'SoftwareController@edit','as'=>'software.edit']);
   Route::post('software/store',['uses'=>'SoftwareController@store','as'=>'software.store']);
   Route::put('software/update/{id}',['uses'=>'SoftwareController@update','as'=>'software.update']);
   Route::delete('software/delete/{id}',['uses'=>'SoftwareController@destroy','as'=>'software.delete']);

   //Action Maintenance
   Route::get('action-maintenance',['uses'=>'ActionMainController@index','as'=>'action.maintenance']);
   Route::get('action-maintenance/show/{id}',['uses'=>'ActionMainController@show','as'=>'action.maintenance.show']);
   Route::get('action-maintenance/create',['uses'=>'ActionMainController@create','as'=>'action.maintenance.create']);
   Route::get('action-maintenance/edit/{id}',['uses'=>'ActionMainController@edit','as'=>'action.maintenance.edit']);
   Route::post('action-maintenance/store',['uses'=>'ActionMainController@store','as'=>'action.maintenance.store']);
   Route::put('action-maintenance/update/{id}',['uses'=>'ActionMainController@update','as'=>'action.maintenance.update']);
   Route::delete('action-maintenance/delete/{id}',['uses'=>'ActionMainController@destroy','as'=>'action.maintenance.delete']);

   //Bugs
   Route::get('bugs',['uses'=>'BugsController@index','as'=>'bugs']);
   Route::get('bugs/show/{id}',['uses'=>'BugsController@show','as'=>'bugs.show']);
   Route::get('bugs/create',['uses'=>'BugsController@create','as'=>'bugs.create']);
   Route::get('bugs/edit/{id}',['uses'=>'BugsController@edit','as'=>'bugs.edit']);
   Route::post('bugs/store',['uses'=>'BugsController@store','as'=>'bugs.store']);
   Route::put('bugs/update/{id}',['uses'=>'BugsController@update','as'=>'bugs.update']);
   Route::delete('bugs/delete/{id}',['uses'=>'BugsController@destroy','as'=>'bugs.delete']);
   Route::get('list-software-detail',['uses'=>'BugsController@get_software_detail']);
   Route::get('bugs/get_bugs',['uses'=>'BugsController@get_bugs']);
   
   //tiket
   Route::get('tiket',['uses'=>'TiketController@index','as'=>'tiket']);
   Route::get('tiket/show/{id}',['uses'=>'TiketController@show','as'=>'tiket.show']);
   Route::get('tiket/create',['uses'=>'TiketController@create','as'=>'tiket.create']);
   Route::get('tiket/edit/{id}',['uses'=>'TiketController@edit','as'=>'tket.edit']);
   Route::post('tiket/store',['uses'=>'TiketController@store','as'=>'tiket.store']);
   Route::put('tiket/update/{id}',['uses'=>'TiketController@update','as'=>'tiket.update']);
   Route::delete('tiket/delete/{id}',['uses'=>'TiketController@destroy','as'=>'tiket.delete']);
   Route::post('tiket/update_support',['uses'=>'TiketController@update_support','as'=>'tiket.update_support']);
   Route::post('tiket/update_batal',['uses'=>'TiketController@update_batal']);
   Route::post('tiket/update_finish',['uses'=>'TiketController@update_finish']);


   //Rencana Kunjungan
   Route::get('rencana-kunjungan',['uses'=>'RencanaKunjunganController@index','as'=>'rencana.kunjungan']);
   Route::get('rencana-kunjungan/show/{id}',['uses'=>'RencanaKunjunganController@show','as'=>'rencana.kunjungan.show']);
   Route::get('rencana-kunjungan/create/{id}',['uses'=>'RencanaKunjunganController@create','as'=>'rencana.kunjungan.create']);
   Route::get('rencana-kunjungan/edit/{id}',['uses'=>'RencanaKunjunganController@edit','as'=>'rencana.kunjungan.edit']);
   Route::post('rencana-kunjungan/store',['uses'=>'RencanaKunjunganController@store','as'=>'rencana.kunjungan.store']);
   Route::put('rencana-kunjungan/update/{id}',['uses'=>'RencanaKunjunganController@update','as'=>'rencana.kunjungan.update']);
   Route::delete('rencana-kunjungan/delete/{id}',['uses'=>'RencanaKunjunganController@destroy','as'=>'rencana.kunjungan.delete']);
   Route::post('rencana-kunjungan/update_approve',['uses'=>'RencanaKunjunganController@update_approve']);


   //Rencana Kunjungan
   Route::get('server-maintenance',['uses'=>'ServerMaintenanceController@index','as'=>'server.maintenance']);
   Route::get('server-maintenance/show/{id}',['uses'=>'ServerMaintenanceController@show','as'=>'server.maintenance.show']);
   Route::get('server-maintenance/create',['uses'=>'ServerMaintenanceController@create','as'=>'server.maintenance.create']);
   Route::get('server-maintenance/edit/{id}',['uses'=>'ServerMaintenanceController@edit','as'=>'server.maintenance.edit']);
   Route::post('server-maintenance/store',['uses'=>'ServerMaintenanceController@store','as'=>'server.maintenance.store']);
   Route::put('server-maintenance/update/{id}',['uses'=>'ServerMaintenanceController@update','as'=>'server.maintenance.update']);
   Route::delete('server-maintenance/delete/{id}',['uses'=>'ServerMaintenanceController@destroy','as'=>'server.maintenance.delete']);
   Route::post('server-maintenance/update_approve',['uses'=>'ServerMaintenanceController@update_approve']);

   #Report
   Route::get('report/client',['uses' => 'ClientController@client_report','as'=>'client.report']);
   Route::get('report/support',['uses' => 'UserController@support_report','as'=>'support.report']);
   Route::get('report/logout-standing',['uses' => 'TiketController@logoutstanding_report','as'=>'logout.standing.report']);
   Route::get('report/maintenance-progress',['uses' => 'TiketController@maintenanceprogress_report','as'=>'maintenance.progress.report']);
   Route::get('report/rencana-kunjungan',['uses' => 'RencanaKunjunganController@rk_report','as'=>'rencana.kunjungan.report']);
   Route::get('report/server-maintenance',['uses' => 'ServerMaintenanceController@sm_report','as'=>'server.maintenance.report']);
   Route::post('report/ls/post',['uses'=>'TiketController@ls_post','as'=>'ls.post']);
   Route::post('report/rk/post',['uses'=>'RencanaKunjunganController@rk_post','as'=>'rk.post']);
   Route::post('report/mp/post',['uses'=>'TiketController@mp_post','as'=>'mp.post']);
   Route::post('report/sm/post',['uses'=>'ServerMaintenanceController@sm_post','as'=>'sm.post']);

});



Route::get('test','UserController@test');

Route::get('create_pm',function(){
   $obj = DB::table('user')->insert(array('nama'=>'Project Manager','email'=>'pm@kompas.com','telepon'=>'0856565656',
                  'type'=>'pm','password'=>Hash::make('hasan'),'status' => 'active','alamat'=>'Rawamangun'));

   if($obj) {
      print "success create users";
   }
   else {
      print "something went wrong";
   }
});

Route::get('create_admin',function(){
   $obj = DB::table('user')->insert(array('nama'=>'Adminsitrator','email'=>'admin@kompas.com','telepon'=>'0856565656',
                  'type'=>'administrator','password'=>Hash::make('hasan'),'status' => 'active','alamat'=>'Rawamangun'));

   if($obj) {
      print "success create users";
   }
   else {
      print "something went wrong";
   }
});

Route::get('create_support',function(){
   $obj = DB::table('user')->insert(array('nama'=>'Tech Support','email'=>'support@kompas.com','telepon'=>'0856565656',
                  'type'=>'support','password'=>Hash::make('hasan'),'status' => 'active','alamat'=>'Rawamangun'));

   if($obj) {
      print "success create users";
   }
   else {
      print "something went wrong";
   }
});

Route::get('create_client',function(){
   $obj = DB::table('user')->insert(array('nama'=>'Client','email'=>'client@kompas.com','telepon'=>'0856565656',
                  'type'=>'client','password'=>Hash::make('hasan'),'status' => 'active','alamat'=>'Rawamangun'));

   if($obj) {
      print "success create users";
   }
   else {
      print "something went wrong";
   }
});

