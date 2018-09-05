@set ($attribute, 'name_x')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'name_y')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($field, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'name_font')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $fonttypes, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'name_font_size')
@set ($field, "{$attribute}_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($field, $fontsizes, old($field, request($field, $row->{$field} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>
