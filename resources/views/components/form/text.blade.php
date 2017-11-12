<div class="form-group row">
    {{ Form::label($name, $labelValue, ['class' => 'col-3 col-form-label', 'required']) }}
    {{ Form::text($name, $nameValue, ['class' => 'form-control col-8', 'required']) }}
</div>