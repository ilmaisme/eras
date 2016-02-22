@extends("template.master")
@section("title","Software Detail")
@section("breadcrumbs",Breadcrumbs::render('view_software',$software))
@section("sidebar_menu")
    @include("menu.support_menu")
@endsection
@section("content")
    <div class="page-content">


        <!-- /section:settings.box -->
        <div class="page-header">
            <h1>
                Software Detail

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
                                                    <div class="profile-info-name"> Name </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $software->nama }}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Versi </div>

                                                    <div class="profile-info-value">
                                                        <span>{{ $software->versi }}</span>
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
                                                <th>Modul Name</th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            <?php $no =1;?>
                                            @foreach($software_detail as $item)
                                                <tr>
                                                    <td class="center">{{ $no }}</td>

                                                    <td>
                                                       {{ $item->nama_modul }}
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
