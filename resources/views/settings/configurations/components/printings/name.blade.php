@set ($attribute, 'name_x')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'name_y')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'name_font')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($attribute, $fonttypes, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'name_font_size')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($attribute, $fontsizes, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>
