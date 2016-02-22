@extends("template.master")
@section("title","Tiket Detail")
@section("breadcrumbs",Breadcrumbs::render('view_tiket',$tiket))
@section("sidebar_menu")
    @include("menu.client_menu")
@endsection
@section("content")
    <div class="page-content">


        <!-- /section:settings.box -->
        <div class="page-header">
            <h1>
                Tiket Detail

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
                                                    <div class="profile-info-name"> No Tiket </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ '#'.sprintf('%03s',$tiket->id_tiket) }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Masalah </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $tiket->masalah }}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Dibuat Tanggal </div>

                                                    <div class="profile-info-value">
                                                        <span>{!! \Erasoft\Libraries\CustomLib::gen_tanggal($tiket->created_at) !!}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Status </div>

                                                    <div class="profile-info-value">
                                                        <span>{!! \Erasoft\Libraries\CustomLib::gen_status_tiket($tiket->status) !!}</span>
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

