@set ($attribute, 'pc_position')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output the postal code to the prescribed position or to the arbitrary position.')"></span>
    </label>

    <div class="col-md-3">
        {!! Form::select($attribute, $positions, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_frame')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('When outputting the postal code to the prescribed position on the upper right, it is possible to select whether or not to output the frame.')"></span>
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $attribute }}" value="0" required checked /> @lang ("elements.words.no")
        </label>
        <label>
            <input type="radio" name="{{ $attribute }}" value="1" required {{ (bool)old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])) === true ? 'checked' : '' }} /> @lang ("elements.words.yes")
        </label>
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_symbol')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('You can choose whether to output the 〒 mark when you want to output the postal code to an arbitrary position.')"></span>
    </label>

    <div class="col-md-7 form-control-static">
        <label>
            <input type="radio" name="{{ $attribute }}" value="1" required checked /> @lang ("elements.words.yes")
        </label>
        <label>
            <input type="radio" name="{{ $attribute }}" value="0" required {{ (bool)old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])) === false ? 'checked' : '' }} /> @lang ("elements.words.no")
        </label>
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_x')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_y')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 3, 'placeholder' => '']) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_font')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($attribute, $fonttypes, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($attribute, 'pc_font_size')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($attribute, $fontsizes, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>
