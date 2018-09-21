@set ($attribute, 'name')
<div class="form-group{{ $errors->{$errorBag}->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$attribute} ?? __('elements.words.settings') . $key)), ['required', 'autofocus', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->{$errorBag}->first($attribute, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@include ('settings.printings.components.pc')

<hr>

@include ('settings.printings.components.address')

<hr>

@include ('settings.printings.components.name')

<hr>

@include ('settings.printings.components.from_pc')

<hr>

@include ('settings.printings.components.from_address')

<hr>

@include ('settings.printings.components.from_name')

<hr>

<div class="form-group">
    <div class="col-md-7 col-md-offset-5">
        <button type="submit" class="btn btn-primary">
            @lang ('elements.words.save')
        </button>
    </div>
</div>
