{!! Form::hidden(null, 'Japan', ['class' => 'p-country-name']) !!}

@set ($field, 'name')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'autofocus', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'kana')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 7, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'postal_code')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('By entering the postal code, the prefecture city, town, village address is automatically entered.')"></span>
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control p-postal-code', 'id' => $field, 'maxlength' => 191, 'placeholder' => __('No hyphen, 7 numeric digits')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'prefecture_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($field, $prefectures->pluckNamesByIds(), old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control p-region-id', 'id' => $field, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'address')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control p-locality p-street-address', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'building_name')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'tel')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'fax')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'email')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::email($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'company_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->company()->name() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'payment_flag')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        <span class="text-{{ $row->{$camel = camel_case($field)}()->asBoolean() === true ? 'success' : 'danger' }}">
            @set ($status, $row->{$camel = camel_case($field)}()->asBoolean() === true ? 'paid' : 'unpaid')
            @lang ("elements.words.{$status}")
        </span>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'user_limit')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}()->asInt() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'starts_at')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'ends_at')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'updated_at')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.stores.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            @lang ('elements.words.save')
        </button>
    </div>
</div>
