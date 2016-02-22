@extends("template.master")
@section("title","Bugs Detail")
@section("breadcrumbs",Breadcrumbs::render('view_bugs',$bugs))
@section("sidebar_menu")
    @include("menu.support_menu")
@endsection
@section("content")
    <div class="page-content">


        <!-- /section:settings.box -->
        <div class="page-header">
            <h1>
                Bugs Detail

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
                                                    <div class="profile-info-name"> Nama Bugs </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $bugs->nama_bugs }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Penyelesaian </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $bugs->penyelesaian }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Software </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $bugs->software->nama }} versi {{ $bugs->software->versi }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Modul </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $bugs->software_detail->nama_modul }}</span>
                                                    </div>
                                                </div>


                                            </div>


                                        </div><!-- /.col -->
                                    </div><!-- /.row -->


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

