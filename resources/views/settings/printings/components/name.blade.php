@set ($attribute, 'name_x')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 3, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

@set ($attribute, 'name_y')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 3, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

@set ($attribute, 'name_font')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($attribute, $fonttypes, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>

@set ($attribute, 'name_font_size')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::select($attribute, $fontsizes, old($attribute, request($attribute, $row->{$attribute} ?? $defaults[$attribute])), ['required', 'class' => 'form-control', 'id' => $attribute]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute, 'errorBag' => $errorBag])
    </div>
</div>
