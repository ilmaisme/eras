@extends("template.master")
@section("title","Tiket Detail")
@section("breadcrumbs",Breadcrumbs::render('view_tiket',$tiket))
@section("sidebar_menu")
    @include("menu.pm_menu")
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
                                                        <span>{!! \Erasoft\Libraries\CustomLib::gen_status_tiket($tiket->status) !!} </span> 
                                                        @if($tiket->status == "open")
                                                            <a id="batal_tiket" data-token="{{ csrf_token() }}" data-id="{{ $tiket->id_tiket }}" style="cursor:pointer;"> Batalkan Tiket ?</a> 
                                                        @endif

                                                        @if($tiket->status == "process")
                                                            <a id="finish_tiket" data-token="{{ csrf_token() }}" data-id="{{ $tiket->id_tiket }}" style="cursor:pointer;"> Finish Tiket ?</a> 
                                                        @endif
                                                    </div>
                                                </div>
                                                

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Pilih Support </div>

                                                    <div class="profile-info-value">
                                                        <span> 
                                                        @if($tiket->id_support==0)
                                                            {!! Form::select('support', $support,null,['class'=>'chosen-select form-control','id'=>'support_name']) !!}
                                                        @else
                                                            {!! Form::select('support', $support,$tiket->id_support,['class'=>'chosen-select form-control','id'=>'support_name','disabled'=>'disabled']) !!}
                                                        @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                @if($tiket->id_support !=0 and $tiket->status == "open")
                                                    <div class="profile-info-row" id="div_ganti_support">
                                                        <div class="profile-info-name">  </div>

                                                        <div class="profile-info-value">
                                                            <span> 
                                                                <a id="ganti_support" style="cursor:pointer">Ganti Support ?</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endif
                                        
                                                <div class="profile-info-row" <?php if($tiket->id_support != 0) { ?> style="display:none" <?php } ?> id="btn_submit">
                                                    <div class="profile-info-name">  </div>

                                                    <div class="profile-info-value">
                                                        <span> <button class="btn btn-info" id="save" data-token="{{ csrf_token() }}" data-id="{{ $tiket->id_tiket }}" >
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                Submit
                                                            </button></span>
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
@section("js_script")
    <script type="application/javascript">
        $('#save').on('click',function(){
            var _data = $('#support_name').val();
            var _id = $(this).data("id");
            var url = '<?php echo url("tiket/update_support");?>';
            var token = $(this).data("token");
            $.post(url, {_token: token,'id_tiket':_id,'id_support':_data}, function(data, textStatus, xhr) {
                if(data.status){
                    alert("sukses update data");
                    location.reload(true);
                }
            });
            
        });

        $('#ganti_support').on('click',function(){
            $('#btn_submit').show();
            $('#div_ganti_support').hide();
            $('#support_name').removeAttr('disabled');
        });

        $('#batal_tiket').on('click',function(){
            var _confirm = confirm("Yakin batalkan tiket ? ");
            if(_confirm){
                var _id = $(this).data("id");
                var url = '<?php echo url("tiket/update_batal");?>';
                var token = $(this).data("token");
                $.post(url, {_token: token,'id_tiket':_id}, function(data, textStatus, xhr) {
                    if(data.status){
                        alert("sukses update data");
                        location.reload(true);
                    }
                });
            }
        });

        $('#finish_tiket').on('click',function(){
            var _confirm = confirm("Yakin Finish tiket ? ");
            if(_confirm){
                var _id = $(this).data("id");
                var url = '<?php echo url("tiket/update_finish");?>';
                var token = $(this).data("token");
                $.post(url, {_token: token,'id_tiket':_id}, function(data, textStatus, xhr) {
                    if(data.status){
                        alert("sukses update data");
                        location.reload(true);
                    }
                });
            }
        });
    </script>
@endsection