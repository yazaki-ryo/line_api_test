{!! Form::hidden(null, 'Japan', ['class' => 'p-country-name']) !!}

@set ($attribute, 'name')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'autofocus', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'kana')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'postal_code')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('By entering the postal code, the prefecture city, town, village address is automatically entered.')"></span>
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control p-postal-code', 'id' => $attribute, 'maxlength' => 7, 'placeholder' => __('No hyphen, 7 numeric digits')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'prefecture_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, $prefectures->pluckNamesByIds(), old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control p-region-id', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'address')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control p-locality p-street-address', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'building')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'tel')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'fax')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'email')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::email($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'plan_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ optional($row->plan())->name() ?? null }}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'user_limit')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        <span class="badge">{{ $row->{$camel = camel_case($attribute)}()->asInt() ?? null }}</span>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'starts_at')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($attribute)}() ?? null }}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'ends_at')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($attribute)}() ?? null }}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'updated_at')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.companies.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($attribute)}() ?? null }}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            @lang ('elements.words.save')
        </button>

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
