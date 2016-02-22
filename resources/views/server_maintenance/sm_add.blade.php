@extends("template.master")
@section("title","Server Maintenance Add")
@section("css_script")

	<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.css') }}" />
@endsection
@section("breadcrumbs",Breadcrumbs::render('add_server_maintenance'))
@section("sidebar_menu")
	@include("menu.support_menu")
@endsection
@section("content")
	<div class="page-content">
					<div class="page-header">
							<h1>
								Server Maintenance
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Server Maintenance
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
								{!! Form::open(array('url' => 'server-maintenance/store','class'=>'form-horizontal','name'=>'')) !!}
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Check </label>

										<div class="col-sm-9">
											
											{!! Form::text('tgl_check', Request::old('tgl_check'),array('class'=>'ol-xs-10 col-sm-5 date-picker','id'=>'id-date-picker-1','data-date-format'=>'yyyy-mm-dd')); !!}
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bulan </label>

										<div class="col-sm-9">
											{!! Form::select('periode', $bulan, Request::old('periode'), ['placeholder' => '--- Bulan ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5']); !!}

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tahun </label>

										<div class="col-sm-9">
											{!! Form::select('tahun', $tahun, Request::old('tahun'), ['placeholder' => '--- Tahun ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5']); !!}

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client </label>

										<div class="col-sm-9">
											{!! Form::select('id_client', $client, Request::old('client'), ['placeholder' => '--- Client ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5']); !!}

										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Service </label>

										<div class="col-sm-9">
											<table id="modul" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													
													<th>No</th>
													<th>Action</th>
													<th>Checked</th>
													<th>Keterangan</th>
												</tr>
											</thead>

											<tbody>
												<?php 
												$no =0;
												?>
												@foreach($service as $key => $data)
													<tr>
														<td>{{ $no+=1}}</td>
														<td><b>{{ $key }}</b></td>
														<td></td>
														<td></td>
													</tr>
													@foreach($data as $k => $v )
														<tr>
															<td></td>
															<td>{{ $v }}</td>
															<td align="center">{!! Form::checkbox('checked[]',$k,null,['onclick'=>'checks(this)']) !!}</td>
															<td>{!! Form::textarea('keterangan['.$k.']', Request::old('keterangan[]'),['rows'=>3,'id'=>'keterangan']); !!}</td>
														</tr>
													@endforeach

												@endforeach

											</tbody>
										</table>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<button class="btn btn-info" type="submit" onclick="check(this);">
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
@section("js_script")
		<script src="{{ asset('assets/js/date-time/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('assets/js/date-time/bootstrap-timepicker.js') }}"></script>
		<script type="text/javascript">
			$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			})
			//show datepicker when clicking on the icon
			.next().on(ace.click_event, function(){
				$(this).prev().focus();
			});

			function add_row(){
				$('#modul tbody').append('<tr><td><input type="text" name="modul_name[]" placeholder="Modul" id="modul_name" class="col-xs-10 col-sm-5"></td><td><button class="btn btn-sm btn-danger" onclick="delete_row(this);" type="button">Delete</button></td></tr>');
			}

			function delete_row(id){
				$(id).parent().parent().remove();
			}

			
			function check(e){
				
				$('form[name=add_sm]').submit(function() {
					var check = $('#keterangan').val();
					
                    if(!check){
                    	alert("Service name must be filled");
                    	return false
                    }

                    return true;
                });
;			}

		</script>

	
		
@endsection















