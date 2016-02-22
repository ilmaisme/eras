@extends("template.master")
@section("title","User List")
@section("breadcrumbs",Breadcrumbs::render('edit_user',$user))
@section("sidebar_menu")
	@include("menu.pm_menu")
@endsection
@section("content")
	<div class="page-content">
					<div class="page-header">
							<h1>
								User
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add User
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							@if(Session::has('error'))
											    {!!  CustomLib::generate_notification(Session::get('error'),"error") !!}
										@endif

										@if(Session::has('success'))
											    {!!  CustomLib::generate_notification(Session::get('success'),"success") !!}
										@endif
							@if(!$errors->isEmpty())
												<?php
													$data ="";
													$data .= '<ul>';
													foreach($errors->all() as $error)
													{
														$data .= '<li>'.$error.'</li>';
													}
													$data .='</ul>';
												?>
												{!! CustomLib::generate_notification($data,"error") !!}  
											@endif

											
								<!-- PAGE CONTENT BEGINS -->

								{!! Form::model($user, array('route' => array('user.update', $user->id_user),'class'=>'form-horizontal','method' => 'PUT')) !!}
									
									{!! Form::hidden('em',$user->email) !!}
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>

										<div class="col-sm-9">
											{!! Form::text('name', $user->nama,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Fullname')); !!}
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>

										<div class="col-sm-9">
											{!! Form::email('email', $user->email,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Email')); !!}
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type </label>

										<div class="col-sm-9">
											{!! Form::select('type', $type, $user->type, ['placeholder' => '--- Type Users ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5']); !!}

										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Clear Form
											</button>
										</div>
									</div>

															
							</form>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
@endsection