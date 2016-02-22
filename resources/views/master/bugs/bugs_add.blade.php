@extends("template.master")
@section("title","Bugs Add")
@section("breadcrumbs",Breadcrumbs::render('add_bugs'))
@section("sidebar_menu")
    @include("menu.support_menu")
@endsection
@section("content")
    <div class="page-content">
        <div class="page-header">
            <h1>
                Bugs
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Add Bugs
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
                {!! Form::open(array('url' => 'bugs/store','class'=>'form-horizontal')) !!}

                        <!-- #section:elements.form -->
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bugs </label>

                    <div class="col-sm-9">
                        {!! Form::text('bugs', Request::old('bugs'),array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Bugs')); !!}

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Penyelesaian </label>

                    <div class="col-sm-9">
                        {!! Form::textarea('penyelesaian', Request::old('penyelesaian'),array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-8','placeholder'=>'Penyelesaian')); !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Software </label>

                    <div class="col-sm-9">
                        {!! Form::select('software', $software, null, ['placeholder' => '--- Software ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5','onchange'=>'get_software_detail(this)']); !!}

                    </div>
                </div>
                <div id="sd"></div>


                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">

                        <button class="btn btn-info" type="submit">
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
   
    <script>
        function get_software_detail(gp){
            var value = $(gp).val();
            $.ajax({
                method:"GET",
                url: "{{ action('BugsController@get_software_detail') }}",
                data: {id_software:value},
                success: function(data){
                    if(data.status == true){
                        $('#sd').html(data.data).slideDown('slow');
                    }
                }
            });
        }
    </script>
@endsection