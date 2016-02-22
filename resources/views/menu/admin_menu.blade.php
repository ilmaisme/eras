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

					
				</ul><!-- /.nav-list -->