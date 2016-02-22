<ul class="nav nav-list">
    <li @if(Route::is('dashboard')) class="active" @endif>
        <a href="{{ url('dashboard') }}">
            <i class="menu-icon fa fa-tachometer"></i>
            <span class="menu-text"> Dashboard </span>
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
    </li>
</ul><!-- /.nav-list -->