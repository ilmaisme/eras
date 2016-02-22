@extends("template.master")
@section("title","Server Maintenance Report")
@section("css_script")
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}" />
@endsection
@section("breadcrumbs",Breadcrumbs::render('sm_report'))
@section("sidebar_menu")
    @include("menu.pm_menu")
@endsection
@section("content")
    <div class="page-content">
        <div class="page-header">
            <h1>
                Server Maintenance Report
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Report
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
                

                        <!-- #section:elements.form -->
                <div class="row">
                                        <div class="col-sm-4">
                                            <div class="widget-box">
                                                <div class="widget-header">
                                                    <h4 class="widget-title">Periode / Client</h4>

                                                    
                                                </div>
                                                {!! Form::open(array('url' => 'report/sm/post','class'=>'form-horizontal','method'=>'POST')) !!}
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        {!! Form::hidden('type','periode_client') !!}
                                                        <label for="id-date-picker-1">Client</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <!-- #section:plugins/date-time.datepicker -->
                                                                {!! Form::select('client',$client,'',['class'=>'chosen-select form-control','id'=>'form-field-select-3','data-placeholder'=>'Pilih Client']) !!}
                                                            </div>
                                                        </div>


                                                        <hr />
                                                        <label for="id-date-range-picker-1">Tahun</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <!-- #section:plugins/date-time.daterangepicker -->
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar bigger-110"></i>
                                                                    </span>

                                                                   {!! Form::select('tahun',$tahun,'',['class'=>'chosen-select form-control','id'=>'form-field-select-3','data-placeholder'=>'Pilih Tahun']) !!}
                                                                    
                                                                </div>

                                                                <!-- /section:plugins/date-time.daterangepicker -->
                                                            </div>
                                                        </div>

                                                        <hr />
                                                        <button class="btn btn-purple btn-sm" type="submit">
                                                                            <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                                                            Search
                                                                        </button>

                                                        <!-- /section:plugins/date-time.datetimepicker -->
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>

                                        
                                    <div class="col-sm-4">
                                            <div class="widget-box">
                                                <div class="widget-header">
                                                    <h4 class="widget-title">Tahun</h4>

                                                    
                                                </div>
                                                {!! Form::open(array('url' => 'report/sm/post','class'=>'form-horizontal','method'=>'POST')) !!}
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        {!! Form::hidden('type','periode') !!}
                                                        <label for="id-date-range-picker-1">Range</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <!-- #section:plugins/date-time.daterangepicker -->
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar bigger-110"></i>
                                                                    </span>

                                                                   {!! Form::select('tahun',$tahun,'',['class'=>'chosen-select form-control','id'=>'form-field-select-3','data-placeholder'=>'Pilih Tahun']) !!}
                                                                </div>

                                                                <!-- /section:plugins/date-time.daterangepicker -->
                                                            </div>
                                                        </div>

                                                        <hr />
                                                        <button class="btn btn-purple btn-sm" type="submit">
                                                                            <span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
                                                                            Search
                                                                        </button>

                                                        <!-- /section:plugins/date-time.datetimepicker -->
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                        
                                    </div>


                </form>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@section("js_script")
    <script src="{{ asset('assets/js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/date-time/moment.js') }}"></script>
    <script src="{{ asset('assets/js/date-time/daterangepicker.js') }}"></script>
    <script>
    $(document).ready(function() {
       

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

            $('#chosen-multiple-style .btn').on('click', function(e){
                        var target = $(this).find('input[type=radio]');
                        var which = parseInt(target.val());
                        if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
                         else $('#form-field-select-4').removeClass('tag-input-style');
                    });
    
    
          
        }
    });
    
       
    </script>
@endsection