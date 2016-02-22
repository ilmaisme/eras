@extends("template.master")
@section("title","Client Add")
@section("css_script")
    <link rel="stylesheet" href="{{ asset("assets/css/chosen.css") }}" />
    <style>
        #mapss {width:500px; height:340px; border:5px solid #DEEBF2;}
    </style>
@endsection
@section("breadcrumbs",Breadcrumbs::render('edit_client',$client))
@section("sidebar_menu")
    @include("menu.pm_menu")
@endsection
@section("content")
    <div class="page-content">
        <div class="page-header">
            <h1>
                Client
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Add Client
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
                {!! Form::model($client,array('url' => 'client/update/'.$client->id_client,'class'=>'form-horizontal','name'=>'add_client','method'=>'PUT')) !!}

                        <!-- #section:elements.form -->
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name (PT) </label>

                    <div class="col-sm-9">
                        {!! Form::text('name_pt', $client->nama_pt,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Fullname')); !!}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> PIC </label>

                    <div class="col-sm-9">
                        {!! Form::text('pic',$client->pic,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Fullname')); !!}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Phone </label>

                    <div class="col-sm-9">
                        {!! Form::text('phone', $client->no_telepon,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Phone Number')); !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Maps </label>

                    <div class="col-sm-9">

                        <div id="mapss"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Address </label>

                    <div class="col-sm-9">
                        {!! Form::textarea('address', $client->alamat,array('class'=>'col-xs-10 col-sm-5','id'=>'address','placeholder'=>'Address')); !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Latitude </label>

                    <div class="col-sm-9">

                        {!! Form::text('lat', $client->lat,array('class'=>'col-xs-10 col-sm-5','id'=>'lat','placeholder'=>'Latitude','readonly'=>'true')); !!}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Longitude </label>

                    <div class="col-sm-9">

                        {!! Form::text('long', $client->long,array('class'=>'col-xs-10 col-sm-5','id'=>'long','placeholder'=>'Longitude','readonly'=>'true')); !!}

                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>

                    <div class="col-sm-9">
                        {!! Form::email('email', $user->email,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Email','disabled'=>'disabled')); !!}
                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Support </label>

                    <div class="col-sm-9">
                        <table id="support" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>Support Name</th>
                                <th><button type="button" id="add_support" class="btn btn-white btn-success" onclick="add_row();">Add</button></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($clientsupport as $item)
                                <tr>
                                    <td>{!! Form::select('support[]', $support,$item->id_support,['class'=>'chosen-select form-control','id'=>'support_name']) !!}</td>
                                    <td><button class="btn btn-sm btn-danger" onclick="delete_row(this);" type="button">Delete</button></td>
                                </tr>
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
    <script src="{{ asset('assets/js/chosen.jquery.js') }}"></script>
    <script type="text/javascript">
        function add_row(){
            $('#support tbody').append('<tr><td>{!! Form::select('support[]', $support,null,['class'=>'chosen-select form-control','id'=>'support_name']) !!}</td><td><button class="btn btn-sm btn-danger" onclick="delete_row(this);" type="button">Delete</button></td></tr>');
            $(".chosen-select").chosen({ width:"95%" });
        }

        function delete_row(id){
            $(id).parent().parent().remove();
        }

        function check(e){

            $('form[name=add_client]').submit(function() {
                var check = $('#support_name').val();

                if(!check){
                    alert("Support must be filled");
                    return false
                }

                return true;
            });
        }

        jQuery(function($) {
            if(!ace.vars['touch']) {
                $('.chosen-select').chosen({allow_single_deselect:true});
                //resize the chosen on window resize

                $(window)
                        .off('resize.chosen')
                        .on('resize.chosen', function() {
                            $('.chosen-select').each(function() {
                                var $this = $(this);
                                $this.next().css({'width': $this.parent().width()});
                            })
                        }).trigger('resize.chosen');
                //resize chosen on sidebar collapse/expand
                $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                    if(event_name != 'sidebar_collapsed') return;
                    $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                    })
                });

            }
        });




    </script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        var geocoder = new google.maps.Geocoder();
        var _lat = "{{ $client->lat }}";
        var _long = "{{ $client->long }}";
        var pt = "{{ $client->nama_pt }}";
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


        function updateMarkerPosition(latLng) {
            document.getElementById('lat').value = latLng.lat();
            document.getElementById('long').value = latLng.lng();
        }

        function updateMarkerAddress(str) {
            document.getElementById('address').innerHTML = str;
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

            // Update current position info.
            updateMarkerPosition(latLng);
            geocodePosition(latLng);

            // Add dragging event listeners.
            google.maps.event.addListener(marker, 'dragstart', function() {
                updateMarkerAddress('Dragging...');
            });

            google.maps.event.addListener(marker, 'drag', function() {
                updateMarkerPosition(marker.getPosition());
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                geocodePosition(marker.getPosition());
            });
        }

        // Onload handler to fire off the app.
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection