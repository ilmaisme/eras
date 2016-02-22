@extends("template.master")
@section("title","Rencana Kunjungan Add")
@section("css_script")
	<style>
        #mapss {width:500px; height:340px; border:5px solid #DEEBF2;}
    </style>
	<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.css') }}" />
@endsection
@section("breadcrumbs",Breadcrumbs::render('add_rencana_kunjungan',$id_tiket))
@section("sidebar_menu")
	@include("menu.support_menu")
@endsection
@section("content")
	<div class="page-content">
					<div class="page-header">
							<h1>
								Rencana Kunjungan
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Add Rencana Kunjungan
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
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
								{!! Form::open(array('url' => 'rencana-kunjungan/store','class'=>'form-horizontal','name'=>'add_rk')) !!}
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Client </label>

										<div class="col-sm-9">
											
											{!! Form::text('nm_client',$tiket->client->nama_pt,array('class'=>'ol-xs-10 col-sm-5 ','disabled'=>'')); !!}
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">  PIC </label>

										<div class="col-sm-9">
											
											{!! Form::text('pic_client',$tiket->client->pic,array('class'=>'ol-xs-10 col-sm-5 ','disabled'=>'')); !!}
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Telepon </label>

										<div class="col-sm-9">
											
											{!! Form::text('tlp_client',$tiket->client->no_telepon,array('class'=>'ol-xs-10 col-sm-5 ','disabled'=>'')); !!}
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Alamat </label>

										<div class="col-sm-9">
											
											
											{!! Form::textarea('alamat_client',$tiket->client->alamat,array('class'=>'ol-xs-10 col-sm-5 ','disabled'=>'')); !!}
											
										</div>
									</div>
									<div class="form-group">
					                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Maps </label>

					                    <div class="col-sm-9">

					                        <div id="mapss"></div>
					                    </div>
					                </div>
									<hr />

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Kunjungan </label>

										<div class="col-sm-9">
											
											{!! Form::text('tgl_kunjungan', Request::old('tgl_kunjungan'),array('class'=>'ol-xs-10 col-sm-5 date-picker','id'=>'id-date-picker-1','data-date-format'=>'yyyy-mm-dd')); !!}
											
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jam Berangkat </label>

										<div class="col-sm-9">

											{!! Form::text('jam_berangkat', Request::old('jam_berangkat'),array('class'=>'col-xs-10 col-sm-5','id'=>'jam_berangkat')); !!}
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jam Pulang </label>

										<div class="col-sm-9">

											{!! Form::text('jam_pulang', Request::old('jam_pulang'),array('class'=>'col-xs-10 col-sm-5','id'=>'jam_pulang')); !!}
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipe Kunjungan </label>

										<div class="col-sm-9">
											{!! Form::radio('tipe_kunjungan','kunjungan') !!}  Kunjungan {!! Form::radio('tipe_kunjungan','remote') !!}  Remote
											
										</div>
									</div>
									<div class="form-group">
					                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Catatan Aktifitas </label>

					                    <div class="col-sm-9">
					                        {!! Form::textarea('aktifitas', Request::old('aktifitas'),array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-8','placeholder'=>'Catatan Aktifitas')); !!}
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cari Bugs & Solusi </label>

					                    <div class="col-sm-9">
					                       <button type="button" class="btn btn-white btn-info btn-bold" id="bootbox-regular">
												<i class="ace-icon glyphicon glyphicon-search bigger-120 blue"></i>
												Cari
											</button>

											<a href="javascript:void(0);" onclick="PopupCenter('{{ route('bugs.create') }}','Add Bugs','600','700')"><button class="btn btn-white btn-primary" type="button">Tambah Data</button></a>
					                    </div>
					                </div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bugs dan Solusi </label>

										<div class="col-sm-9">
											<table id="modul" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													
													<th>Bugs Name</th>
													<th>Penyelesaian</th>
													<th>Aplikasi</th>
													<th>Modul</th>
													<th>Hapus</th>
												</tr>

											</thead>

											<tbody id="bugs">
												
											</tbody>
										</table>
										</div>
									</div>
									<input type="hidden" name="id_tiket" value="{{ $id_tiket }}">
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
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        var geocoder = new google.maps.Geocoder();
        var _lat = "{{ $tiket->client->lat }}";
        var _long = "{{ $tiket->client->long }}";
        var pt = "{{ $tiket->client->nama_pt }}";
        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    updateMarkerAddress(responses[0].formatted_address);
                } else {
                    updateMarkerAddress('Cannot determine address at this location.');
                }
            });
        }


        function initialize() {
            var latLng = new google.maps.LatLng( _lat, _long);
            var map = new google.maps.Map(document.getElementById('mapss'), {
                zoom: 13,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latLng,
                title: pt,
                map: map,
                draggable: true
            });

           
        }

        // Onload handler to fire off the app.
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
		<script src="{{ asset('assets/js/date-time/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('assets/js/date-time/bootstrap-timepicker.js') }}"></script>
		<script src="{{ asset('assets/js/bootbox.js') }}"></script>

		<script type="text/javascript">

			$("#bootbox-regular").on(ace.click_event, function(e) {
				e.preventDefault();
				var url = "{{ url('bugs/get_bugs') }}";
				$.get(url, function(data) {
					
					bootbox.dialog({
						title:"Bugs List",
						message:data.view,

					});
				});

				// bootbox.dialog({

				// });
			});

			$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			})
			//show datepicker when clicking on the icon
			.next().on(ace.click_event, function(){
				$(this).prev().focus();
			});

			$('#jam_berangkat').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});

			$('#jam_pulang').timepicker({
				minuteStep: 1,
				showSeconds: true,
				showMeridian: false
			}).next().on(ace.click_event, function(){
				$(this).prev().focus();
			});

			function add_row(){
				$('#modul tbody').append('<tr><td><input type="text" name="modul_name[]" placeholder="Modul" id="modul_name" class="col-xs-10 col-sm-5"></td><td><button class="btn btn-sm btn-danger" onclick="delete_row(this);" type="button">Delete</button></td></tr>');
			}

			function delete_row(id){
				$(id).parent().parent().remove();
			}

			function check(e){
				
				$('form[name=add_rk]').submit(function() {
					var check = $('#bugs_add').val();
					
                    if(!check){
                    	alert("Bugs name must be filled");
                    	return false
                    }

                    return true;
                });
;			}

		</script>

	
		
@endsection