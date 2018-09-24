@set ($attribute, 'name')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'autofocus', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'email')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::email($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'company_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::text(null, $row->company()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $attribute]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'store_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::text(null, $row->store()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $attribute]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'role_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::text(null, $row->role()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $attribute]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@env ('local')
    @set ($attribute, 'avatar')
    @set ($attribute2, 'drop_avatar')
    <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang ("attributes.users.{$attribute}")
        </label>

        <div class="col-md-6 form-control-static">
            @include ('users.components.avatars')

            {!! Form::file($attribute, null, ['class' => 'form-control', 'id' => $attribute, 'placeholder' => '']) !!}
            {!! Form::hidden('MAX_FILE_SIZE', 2097152) !!}<!-- いずれ設定値から取得 -->
            @include ('components.form.err_msg', ['attribute' => $attribute])

            @if ($row->avatars()->count())
                <div class="checkbox">
                    <label>{!! Form::checkbox($attribute2, 1, old($attribute2), ['class' => '', 'id' => $attribute2]) !!} @lang ('Delete the current image.')</label>
                    @include ('components.form.err_msg', ['attribute' => $attribute2])
                </div>
            @endif
        </div>
    </div>
@endenv

@set ($attribute, 'password')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">@lang ("attributes.users.{$attribute}")</label>

    <div class="col-md-6">
        <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" placeholder="@lang ('Please input only when changing.')" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'password_confirmation')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">@lang ("attributes.users.{$attribute}")</label>

    <div class="col-md-6">
        <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" placeholder="@lang ('Please re-enter for confirmation.')" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'updated_at')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
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
