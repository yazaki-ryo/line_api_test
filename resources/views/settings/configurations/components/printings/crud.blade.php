@set ($field, "name_{$key}")
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-5 control-label">
        @lang ("attributes.settings.printings.name")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$field} ?? __('elements.actions.set') . $key)), ['required', 'autofocus', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@include ('settings.configurations.components.printings.pc')

<hr>

@include ('settings.configurations.components.printings.address')

<hr>

@include ('settings.configurations.components.printings.name')

<hr>

@include ('settings.configurations.components.printings.sender_pc')

<hr>

@include ('settings.configurations.components.printings.sender_address')

<hr>

@include ('settings.configurations.components.printings.sender_name')

<hr>

<div class="form-group">
    <div class="col-md-7 col-md-offset-5">
        <button type="submit" class="btn btn-primary">
            @lang ('elements.actions.save')
        </button>
    </div>
</div>
