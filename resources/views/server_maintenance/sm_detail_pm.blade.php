@extends("template.master")
@section("title","Server Maintenance Detail")
@section("breadcrumbs",Breadcrumbs::render('view_server_maintenance',$sm))
@section("sidebar_menu")
    @include("menu.pm_menu")
@endsection
@section("content")
    <div class="page-content">


        <!-- /section:settings.box -->
        <div class="page-header">
            <h1>
                Server Maintenance Detail

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
                                                    <div class="profile-info-name"> Tgl Check </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ \Erasoft\Libraries\CustomLib::gen_tanggal($sm->tgl_check) }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Periode </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ \Erasoft\Libraries\CustomLib::gen_bulan($sm->periode) }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Tahun </div>

                                                    <div class="profile-info-value">
                                                        <span>{!! $sm->tahun !!}</span>
                                                    </div>
                                                </div>


                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Client </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $sm->client->nama_pt }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Status </div>

                                                    <div class="profile-info-value">
                                                        <span>{!! \Erasoft\Libraries\CustomLib::gen_status_t($sm->status) !!}</span> 
                                                        @if($sm->status == "waiting")
                                                            <a id="approve_sm" data-token="{{ csrf_token() }}" data-id="{{ $sm->id_sm }}" style="cursor:pointer;"> Approve Server Maintenance ?</a> 
                                                        @endif
                                                    </div>
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
                                                <th>Nama Action</th>
                                                <th>Keterangan</th>
                                                

                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php $no =1;?>
                                            @foreach($sm_detail as $item)
                                                <tr>
                                                    <td class="center">{{ $no }}</td>

                                                    <td>
                                                       {{ $item->am_detail->am->nama_action.' -> '.$item->am_detail->nama }}
                                                    </td>
                                                    <td>{{ $item->keterangan }}</td>
                                                   

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
    <script type="text/javascript">
    $('#approve_sm').on('click',function(){
            var _confirm = confirm("Yakin Approve Server Maintenance ? ");
            if(_confirm){
                var _id = $(this).data("id");
                var url = '<?php echo url("server-maintenance/update_approve");?>';
                var token = $(this).data("token");
                $.post(url, {_token: token,'id_sm':_id}, function(data, textStatus, xhr) {
                    if(data.status){
                        alert("sukses update data");
                        location.reload(true);
                    }
                });
            }
        });
    </script>
@endsection 