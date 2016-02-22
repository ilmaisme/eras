@extends("template.master")
@section("title","Software Add")
@section("breadcrumbs",Breadcrumbs::render('edit_software',$software))
@section("sidebar_menu")
    @include("menu.support_menu")
@endsection
@section("content")
    <div class="page-content">
        <div class="page-header">
            <h1>
                Software
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Edit Software
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
                {!! Form::model($software, array('route' => array('software.update', $software->id_software),'class'=>'form-horizontal','method' => 'PUT','name'=>'add_software')) !!}

                        <!-- #section:elements.form -->
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>

                    <div class="col-sm-9">
                        {!! Form::text('name', $software->nama,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Software Name')); !!}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Version </label>

                    <div class="col-sm-9">
                        {!! Form::text('version', $software->versi,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Version')); !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Modul </label>

                    <div class="col-sm-9">
                        <table id="modul" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>Modul Name</th>
                                <th><button type="button" id="add_modul" class="btn btn-white btn-success" onclick="add_row();">Add</button></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($software_detail as $item)
                                <tr>
                                    <td><input type="text" name="modul_name[]" placeholder="Modul" id="modul_name" value="{{ $item->nama_modul }}" class="col-xs-10 col-sm-5"></td>
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
    <script type="text/javascript">

        function add_row(){
            $('#modul tbody').append('<tr><td><input type="text" name="modul_name[]" placeholder="Modul" id="modul_name" class="col-xs-10 col-sm-5"></td><td><button class="btn btn-sm btn-danger" onclick="delete_row(this);" type="button">Delete</button></td></tr>');
        }

        function delete_row(id){
            $(id).parent().parent().remove();
        }

        function check(e){

            $('form[name=add_software]').submit(function() {
                var check = $('#modul_name').val();

                if(!check){
                    alert("Modul name must be filled");
                    return false
                }

                return true;
            });
        }	

    </script>

@endsection