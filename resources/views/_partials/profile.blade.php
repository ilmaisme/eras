@extends("template.master")
@section("meta")
<meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
@endsection
@section("title","User List")
@section("breadcrumbs",Breadcrumbs::render('profile_user',$user))
@section("sidebar_menu")
    @if(Auth::user()->type == "admin")
	    @include("menu.admin_menu")
    @elseif(Auth::user()->type == "pm")
        @include("menu.pm_menu")
    @elseif(Auth::user()->type == "support")
        @include("menu.support_menu")
    @endif
@endsection
@section("content")
	<div class="page-content">
						

						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								User Profile
								
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">

								<div id="profile">
									<div id="user-profile-2" class="user-profile">
										<div class="tabbable">
											<ul class="nav nav-tabs padding-18">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														Profile
													</a>
												</li>	
											</ul>

											<div class="tab-content no-border padding-24">
												<div id="home" class="tab-pane in active">
													<div class="row">
														<div class="col-xs-12 col-sm-3 center">
															<span class="profile-picture">
																<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{ asset('assets/images/icon-user-default.png') }}" />
															</span>

															<div class="space space-4"></div>

															<a  class="btn btn-sm btn-block btn-success" id="cprofile">
																<i class="ace-icon fa fa-pencil align-top bigger-120"></i>
																<span class="bigger-110">Change Profile</span>
															</a>
														</div><!-- /.col -->

														<div class="col-xs-12 col-sm-9">
															<h4 class="blue">
																<span class="middle">{{ $user->nama }}</span>

																
															</h4>

															<div class="profile-user-info">
																<div class="profile-info-row">
																	<div class="profile-info-name"> Email </div>

																	<div class="profile-info-value">
																		<span>{{ $user->email }}</span>
																	</div>
																</div>


																<div class="profile-info-row">
																	<div class="profile-info-name"> Status </div>

																	<div class="profile-info-value">
																		<span>{{ $user->status }}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Type </div>

																	<div class="profile-info-value">
																		<span>{{ $user->type }}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Joined </div>

																	<div class="profile-info-value">
																		<span>{{ $user->created_at }}</span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Last Online </div>

																	<div class="profile-info-value">
																		<span>{{ CustomLib::time_ago(strtotime($user->updated_at)) }}</span>
																	</div>
																</div>
															</div>

															
														</div><!-- /.col -->
													</div><!-- /.row -->

													<div class="space-20"></div>
												</div><!-- /#home -->
											</div>
										</div>
									</div>
								</div>
								<div id="change_profile">
									<div id="user-profile-3" class="user-profile row">
										<div class="col-sm-offset-1 col-sm-10">
											
											<form class="form-horizontal" id="update_profile_form">
												<div class="tabbable">
													<ul class="nav nav-tabs padding-16">
														<li class="active">
															<a data-toggle="tab" href="#edit-basic">
																<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
																Basic Info
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-password">
																<i class="blue ace-icon fa fa-key bigger-125"></i>
																Password
															</a>
														</li>
													</ul>

													<div class="tab-content profile-edit-tab-content">

														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller">General</h4>
															<div class="alert"></div>
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-date">Name</label>
																<div class="col-sm-9">
																		<input type="hidden" name="id_user" value="{{ $user->id_user }}">
																		<input type="text" id="form-field-email" class="user_name" name="name" />
																		
																</div>
																
															</div>
															<div class="space-4"></div>


															<div class="space"></div>
															<h4 class="header blue bolder smaller">Contact</h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-email">Email</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input type="email" id="form-field-email" class="user_email" disabled="disabled" name="email" />
																		<i class="ace-icon fa fa-envelope"></i>
																	</span>
																</div>
															</div>

														</div>


														<div id="edit-password" class="tab-pane">
															
															<div class="alert"></div>
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">New Password</label>

																<div class="col-sm-9">
																	<input type="password" id="form-field-pass1" name="password" />
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Confirm Password</label>

																<div class="col-sm-9">
																	<input type="password" id="form-field-pass2" name="password_confirmation" />
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit" id="save">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Save
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Reset
														</button>
													</div>
												</div>
											</form>
										</div><!-- /.span -->
									</div><!-- /.user-profile -->
								</div>

								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
@endsection
@section("js_script")
		<script src="{{ asset('assets/js/jquery-ui.custom.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.gritter.js') }}"></script>
		<script src="{{ asset('assets/js/bootbox.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.easypiechart.js') }}"></script>
		<script src="{{ asset('assets/js/date-time/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.hotkeys.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-wysiwyg.js') }}"></script>
		<script src="{{ asset('assets/js/select2.js') }}"></script>
		<script src="{{ asset('assets/js/fuelux/fuelux.spinner.js') }}"></script>
		<script src="{{ asset('assets/js/x-editable/bootstrap-editable.js') }}"></script>
		<script src="{{ asset('assets/js/x-editable/ace-editable.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.maskedinput.js') }}"></script>
	<script type="text/javascript">
			jQuery(function($) {
				$('#change_profile').hide();
				$('#cprofile').on('click',function(){
					var url = '{{ route("get.user") }}';
					$.get( url, function( data ) {
					  $('.user_name').val(data.nama);
					  $('.user_email').val(data.email);
					  $('#change_profile').slideDown('slow');
					});
				});

				$('#save').on('click',function(e){
					e.preventDefault();
					var url = "{{ route('update.profile') }}";
					var data = $('#update_profile_form').serialize();

					$.ajax({
						headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
						url: url,
						type: 'PUT',
						dataType: 'json',
						data: data,
					})
					.done(function(data) {
						if(data.status == false || data.status == true){
							$('.alert').html(data.message).hide().slideDown('slow');
						}

						console.log("success");
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
					
				});

						
				
			  
			});
		</script>
@endsection