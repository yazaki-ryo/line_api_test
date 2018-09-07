@set ($attribute, 'from_flag')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output information of sender such as zip code, address, name etc.')"></span>
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $attribute }}" value="1" required checked /> @lang ("elements.labels.yes")
        </label>
        <label>
            <input type="radio" name="{{ $attribute }}" value="0" required {{ (bool)old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])) === false ? 'checked' : '' }} /> @lang ("elements.labels.no")
        </label>
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'from_pc_symbol')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $attribute }}" value="1" required checked /> @lang ("elements.labels.yes")
        </label>
        <label>
            <input type="radio" name="{{ $attribute }}" value="0" required {{ (bool)old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])) === false ? 'checked' : '' }} /> @lang ("elements.labels.no")
        </label>
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'from_pc_x')
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

@set ($attribute, 'from_pc_y')
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

@set ($attribute, 'from_pc_font')
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

@set ($attribute, 'from_pc_font_size')
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
