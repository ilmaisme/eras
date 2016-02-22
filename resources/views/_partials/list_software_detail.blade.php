<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Modul </label>

    <div class="col-sm-9">
        {!! Form::select('software_detail', $sd, null, ['placeholder' => '--- Modul ---','id'=>'form-field-select-1','class'=>'col-xs-10 col-sm-5']); !!}

    </div>
</div>