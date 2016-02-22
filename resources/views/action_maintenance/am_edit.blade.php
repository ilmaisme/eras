@extends("template.master")
@section("title","Action Maintenance Edit")
@section("breadcrumbs",Breadcrumbs::render('edit action maintenance',$am))
@section("sidebar_menu")
    @include("menu.support_menu")
@endsection
@section("content")
    <div class="page-content">
        <div class="page-header">
            <h1>
                Action Maintenance
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Edit Action Maintenance
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
                {!! Form::model($am, array('route' => array('action.maintenance.update', $am->id_actions),'class'=>'form-horizontal','method' => 'PUT','name'=>'add_am')) !!}

                        <!-- #section:elements.form -->
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>

                    <div class="col-sm-9">
                        {!! Form::text('nama', $am->nama_action,array('class'=>'col-xs-10 col-sm-5','id'=>'form-field-1','placeholder'=>'Nama')); !!}

                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Detail </label>

                    <div class="col-sm-9">
                        <table id="modul" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>

                                <th>Detail Name</th>
                                <th><button type="button" id="add_detail" class="btn btn-white btn-success" onclick="add_row();">Add</button></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($am_detail as $item)
                                <tr>
                                    <td><input type="text" name="am_detail[]" placeholder="Detail" id="am_detail" value="{{ $item->nama }}" class="col-xs-10 col-sm-5"></td>
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
            $('#modul tbody').append('<tr><td><input type="text" name="am_detail[]" placeholder="Detail" id="am_detail" class="col-xs-10 col-sm-5"></td><td><button class="btn btn-sm btn-danger" onclick="delete_row(this);" type="button">Delete</button></td></tr>');
        }

        function delete_row(id){
            $(id).parent().parent().remove();
        }

        function check(e){

            $('form[name=add_am]').submit(function() {
                var check = $('#am_detail').val();

                if(!check){
                    alert("Detail name must be filled");
                    return false
                }

                return true;
            });
        }	

    </script>

@endsection