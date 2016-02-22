<?php

//Dashboard
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

//User
Breadcrumbs::register('user', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('User', route('user'));
});

Breadcrumbs::register('add_user', function($breadcrumbs)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push('Add', route('user.create'));
});

Breadcrumbs::register('edit_user', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push($user->nama, route('user.edit', $user->id_user));
});

Breadcrumbs::register('view_user', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('user');
    $breadcrumbs->push($user->nama, route('user.show', $user->id_user));
});

Breadcrumbs::register('profile_user', function($breadcrumbs, $user)
{
	$breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Profile', route('user.show', $user->id_user));
});

//Action Maintenance
Breadcrumbs::register('action maintenance', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Action Maintenance', route('action.maintenance'));
});

Breadcrumbs::register('add action maintenance', function($breadcrumbs)
{
    $breadcrumbs->parent('action maintenance');
    $breadcrumbs->push('Add', route('action.maintenance.create'));
});

Breadcrumbs::register('edit action maintenance', function($breadcrumbs, $am)
{
    $breadcrumbs->parent('action maintenance');
    $breadcrumbs->push($am->nama_action, route('user.edit', $am->id_actions));
});

Breadcrumbs::register('view action maintenance', function($breadcrumbs, $am)
{
    $breadcrumbs->parent('action maintenance');
    $breadcrumbs->push($am->nama_action, route('user.show', $am->id_actions));
});



//Software
Breadcrumbs::register('software & bugs', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Software & Bugs', '#');
});

Breadcrumbs::register('software', function($breadcrumbs)
{
    $breadcrumbs->parent('software & bugs');
    $breadcrumbs->push('Software', route('software'));
});

Breadcrumbs::register('add_software', function($breadcrumbs)
{
    $breadcrumbs->parent('software');
    $breadcrumbs->push('Add', route('software.create'));
});

Breadcrumbs::register('edit_software', function($breadcrumbs, $software)
{
    $breadcrumbs->parent('software');
    $breadcrumbs->push($software->nama, route('software.edit', $software->id_software));
});

Breadcrumbs::register('view_software', function($breadcrumbs, $software)
{
    $breadcrumbs->parent('software');
    $breadcrumbs->push($software->nama, route('software.show', $software->id_software));
});

//Bugs
Breadcrumbs::register('bugs', function($breadcrumbs)
{
    $breadcrumbs->parent('software & bugs');
    $breadcrumbs->push('Bugs', route('bugs'));
});

Breadcrumbs::register('add_bugs', function($breadcrumbs)
{
    $breadcrumbs->parent('bugs');
    $breadcrumbs->push('Add', route('bugs.create'));
});

Breadcrumbs::register('edit_bugs', function($breadcrumbs, $bugs)
{
    $breadcrumbs->parent('bugs');
    $breadcrumbs->push($bugs->nama_bugs, route('software.edit', $bugs->id_bugs));
});

Breadcrumbs::register('view_bugs', function($breadcrumbs, $bugs)
{
    $breadcrumbs->parent('bugs');
    $breadcrumbs->push($bugs->nama_bugs, route('bugs.show', $bugs->id_bugs));
});

//User
Breadcrumbs::register('client', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Client', route('client'));
});

Breadcrumbs::register('add_client', function($breadcrumbs)
{
    $breadcrumbs->parent('client');
    $breadcrumbs->push('Add', route('client.create'));
});

Breadcrumbs::register('edit_client', function($breadcrumbs, $client)
{
    $breadcrumbs->parent('client');
    $breadcrumbs->push($client->nama_pt, route('client.edit', $client->id_client));
});

Breadcrumbs::register('view_client', function($breadcrumbs, $client)
{
    $breadcrumbs->parent('client');
    $breadcrumbs->push($client->nama_pt, route('client.show', $client->id_client));
});

//tiket
Breadcrumbs::register('tiket', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Tiket', route('tiket'));
});

Breadcrumbs::register('add_tiket', function($breadcrumbs)
{
    $breadcrumbs->parent('tiket');
    $breadcrumbs->push('Add', route('tiket.create'));
});

Breadcrumbs::register('edit_tiket', function($breadcrumbs, $tiket)
{
    $breadcrumbs->parent('client');
    $breadcrumbs->push($tiket->nama_pt, route('tiket.edit', $client->id_tiket));
});

Breadcrumbs::register('view_tiket', function($breadcrumbs, $tiket)
{
    $breadcrumbs->parent('client');
    $breadcrumbs->push($tiket->id_tiket, route('tiket.show', $tiket->id_tiket));
});

//maintenance
Breadcrumbs::register('maintenance', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Maintenance', '#');
});

Breadcrumbs::register('rencana_kunjungan', function($breadcrumbs)
{
    $breadcrumbs->parent('maintenance');
    $breadcrumbs->push('Rencana Kunjungan', route('rencana.kunjungan'));
});

Breadcrumbs::register('add_rencana_kunjungan', function($breadcrumbs,$tiket)
{
    $breadcrumbs->parent('rencana_kunjungan');
    $breadcrumbs->push('Add', route('rencana.kunjungan.create',$tiket));
});

Breadcrumbs::register('edit_rencana_kunjungan', function($breadcrumbs, $rk)
{
    $breadcrumbs->parent('rencana_kunjungan');
    $breadcrumbs->push($rk->id_rk, route('rencana.kunjungan.edit', $rk->id_rk));
});

Breadcrumbs::register('view_rencana_kunjungan', function($breadcrumbs, $rk)
{
    $breadcrumbs->parent('rencana_kunjungan');
    $breadcrumbs->push($rk->id_rk, route('rencana.kunjungan.show', $rk->id_rk));
});

#server maintenance
Breadcrumbs::register('server_maintenance', function($breadcrumbs)
{
    $breadcrumbs->parent('maintenance');
    $breadcrumbs->push('Server Maintenance', route('server.maintenance'));
});

Breadcrumbs::register('add_server_maintenance', function($breadcrumbs)
{
    $breadcrumbs->parent('server_maintenance');
    $breadcrumbs->push('Add', route('server.maintenance.create'));
});

Breadcrumbs::register('edit_server_maintenance', function($breadcrumbs, $sm)
{
    $breadcrumbs->parent('server_maintenance');
    $breadcrumbs->push($sm->id_sm, route('server.maintenance.edit', $sm->id_sm));
});

Breadcrumbs::register('view_server_maintenance', function($breadcrumbs, $sm)
{
    $breadcrumbs->parent('server_maintenance');
    $breadcrumbs->push($sm->id_sm, route('server.maintenance.show', $sm->id_sm));
});


#report
Breadcrumbs::register('laporan', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Laporan', '#');
});

Breadcrumbs::register('client_report', function($breadcrumbs)
{
    $breadcrumbs->parent('laporan');
    $breadcrumbs->push('Client Report', route('client.report'));
});

Breadcrumbs::register('support_report', function($breadcrumbs)
{
    $breadcrumbs->parent('laporan');
    $breadcrumbs->push('Support Report', route('support.report'));
});

Breadcrumbs::register('logoutstanding_report', function($breadcrumbs)
{
    $breadcrumbs->parent('laporan');
    $breadcrumbs->push('Log Out Standing Report', route('logout.standing.report'));
});

Breadcrumbs::register('maintenanceprogress_report', function($breadcrumbs)
{
    $breadcrumbs->parent('laporan');
    $breadcrumbs->push('Maintenance Progress Report', route('maintenance.progress.report'));
});

Breadcrumbs::register('rk_report', function($breadcrumbs)
{
    $breadcrumbs->parent('laporan');
    $breadcrumbs->push('Rencana Kunjungan Report', route('rencana.kunjungan.report'));
});

Breadcrumbs::register('sm_report', function($breadcrumbs)
{
    $breadcrumbs->parent('laporan');
    $breadcrumbs->push('Server Maintenance Report', route('server.maintenance.report'));
});