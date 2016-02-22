<ul class="nav nav-list">
    <li @if(Route::is('dashboard')) class="active" @endif>
        <a href="{{ url('dashboard') }}">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> Dashboard </span>
        </a>

        <b class="arrow"></b>
    </li>

    <li @if(Route::is('user') || Route::is('user.create') || Route::is('user.edit') || Route::is('user.show')) class="active" @endif >
        <a href="{{ route('user') }}">
            <i class="menu-icon glyphicon glyphicon-user "></i>
            <span class="menu-text"> User </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li @if(Route::is('client') || Route::is('client.create') || Route::is('client.edit') || Route::is('client.show')) class="active" @endif >
        <a href="{{ route('client') }}">
            <i class="menu-icon glyphicon glyphicon-user "></i>
            <span class="menu-text"> Client </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li @if(Route::is('tiket') || Route::is('tiket.create') || Route::is('tiket.edit') || Route::is('tiket.show')) class="active" @endif >
        <a href="{{ route('tiket') }}">
            <i class="menu-icon glyphicon glyphicon-pencil"></i>
            <span class="menu-text"> Tiket </span>
        </a>

        <b class="arrow"></b>
    </li>
    <li @if(Route::is('rencana.kunjungan') || Route::is('rencana.kunjungan.show') || Route::is('rencana.kunjungan.create') || Route::is('rencana.kunjungan.edit') || Route::is('server.maintenance') || Route::is('server.maintenance.show') || Route::is('server.maintenance.create') || Route::is('server.maintenance.edit')) class="active open" @endif>
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text"> Maintenance </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li @if(Route::is('rencana.kunjungan') || Route::is('rencana.kunjungan.show') || Route::is('rencana.kunjungan.create') || Route::is('rencana.kunjungan.edit')) class="active" @endif>
                                <a href="{{ url('rencana-kunjungan') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Rencana Kunjungan
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li @if(Route::is('server.maintenance') || Route::is('server.maintenance.show') || Route::is('server.maintenance.create') || Route::is('server.maintenance.edit')) class="active" @endif>
                                <a href="{{ url('server-maintenance') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Server Maintenance
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>

    <li @if(Route::is('client.report') || Route::is('support.report') || Route::is('logout.standing.report') || Route::is('rencana.kunjungan.report') || Route::is('server.maintenance.report') || Route::is('ls.post') || Route::is('rk.post') || Route::is('sm.post') || Route::is('maintenance.progress.report') || Route::is('mp.post')) class="active open" @endif>
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-tag"></i>
                            <span class="menu-text"> Laporan </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li @if(Route::is('client.report')) class="active" @endif>
                                <a href="{{ url('report/client') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Client
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li @if(Route::is('support.report')) class="active" @endif>
                                <a href="{{ url('report/support') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Support
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li @if(Route::is('logout.standing.report') || Route::is('ls.post')) class="active" @endif>
                                <a href="{{ url('report/logout-standing') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Log Out Standing
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li @if(Route::is('maintenance.progress.report') || Route::is('mp.post')) class="active" @endif>
                                <a href="{{ url('report/maintenance-progress') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Maintenance Progress Report
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li @if(Route::is('rencana.kunjungan.report') || Route::is('rk.post')) class="active" @endif>
                                <a href="{{ url('report/rencana-kunjungan') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Rencana Kunjungan
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li @if(Route::is('server.maintenance.report') || Route::is('sm.post')) class="active" @endif>
                                <a href="{{ url('report/server-maintenance') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Server Maintenance
                                </a>

                                <b class="arrow"></b>
                            </li>

                            
                        </ul>
                    </li>


</ul><!-- /.nav-list -->