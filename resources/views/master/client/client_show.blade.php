@extends("template.master")
@section("title","Client Detail")
@section("css_script")
    <style>
        #mapss {width:500px; height:340px; border:5px solid #DEEBF2;}
    </style>
@endsection
@section("breadcrumbs",Breadcrumbs::render('view_client',$client))
@section("sidebar_menu")
    @include("menu.pm_menu")
@endsection
@section("content")
    <div class="page-content">


        <!-- /section:settings.box -->
        <div class="page-header">
            <h1>
                Client Detail

            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">

                <div>
                    <div id="user-profile-2" class="user-profile">
                        <div class="tabbable">
                            <ul class="nav nav-tabs padding-18">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        <i class="green ace-icon fa fa-user bigger-120"></i>
                                        Information
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content no-border padding-24">
                                <div id="home" class="tab-pane in active">
                                    <div class="row">


                                        <div class="col-xs-12 col-sm-12">

                                            <div class="profile-user-info">
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Nama PT </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $client->nama_pt }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> PIC </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $client->pic }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Telepon </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $client->no_telepon }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Alamat </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $client->alamat }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Email </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $user->email }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Maps </div>

                                                    <div id="mapss"></div>
                                                </div>

                                            </div>


                                        </div><!-- /.col -->
                                    </div><!-- /.row -->

                                    <div class="space-20"></div>
                                    <div>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Support</th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php $no =1;?>
                                            @foreach($client->support as $item)
                                                <tr>
                                                    <td class="center">{{ $no }}</td>

                                                    <td>
                                                        {{ $item->nama }}
                                                    </td>

                                                </tr>
                                                <?php $no++; ?>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- /#home -->
                            </div>
                        </div>
                    </div>
                </div>



                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
@endsection
@section("js_script")

    <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
    <script type="text/javascript">
        var geocoder = new google.maps.Geocoder();
        var _lat = "{{ $client->lat }}";
        var _long = "{{ $client->long }}";
        var pt = "{{ $client->nama_pt }}";




        function initialize() {
            var latLng = new google.maps.LatLng( _lat, _long);
            var map = new google.maps.Map(document.getElementById('mapss'), {
                zoom: 15,
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latLng,
                title: pt,
                map: map,
                draggable: false
            });


        }

        // Onload handler to fire off the app.
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection