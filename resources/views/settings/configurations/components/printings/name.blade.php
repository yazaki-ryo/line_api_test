@set ($field, "name_x_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.name_x")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? 15)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "name_y_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.name_y")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? 40)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "name_font_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.name_font")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $fonts, old($field, request($field, $row->{$field} ?? 'gothic')), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, "name_font_size_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.name_font_size")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $font_sizes, old($field, request($field, $row->{$field} ?? 14)), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>
