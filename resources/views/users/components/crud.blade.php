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

    <div class="col-md-6 form-control-static">
        {{ optional($row->company())->name() ?? optional($user->company())->name() }}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'store_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, $stores->pluckNamesByIds(), old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? $user->{$camel}())), [$user->cant('roles', 'company-admin') ? 'readonly' : null, 'required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'role_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, $roles->pluckNamesByIds(), old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? $user->{$camel}())), [$user->cant('roles', 'company-admin') ? 'readonly' : null, 'required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@env ('local')
    @if ($mode === 'profile')
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
    @endif
@endenv

@set ($attribute, 'password')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")

        @if ($mode === 'add') <span class="label label-danger">@lang ("elements.words.required")</span> @endif
    </label>

    <div class="col-md-6">
        <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" placeholder="{{ $mode === 'edit' || $mode === 'profile' ? __('Please input only when changing.') : '' }}" {{ $mode === 'add' ? 'required' : '' }} />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'password_confirmation')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.users.{$attribute}")

        @if ($mode === 'add') <span class="label label-danger">@lang ("elements.words.required")</span> @endif
    </label>

    <div class="col-md-6">
        <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" placeholder="{{ $mode === 'edit' || $mode === 'profile' ? __('Please re-enter for confirmation.') : '' }}" {{ $mode === 'add' ? 'required' : '' }} />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@if ($mode === 'edit' || $mode === 'profile')
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
@endif

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            @can ('authorize', ['users.*', 'users.create'])
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit' || $mode === 'profile')
            @can ('authorize', ['users.*', 'users.update'])
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @if ($mode === 'edit')
                @can ('authorize', ['users.*', 'users.delete'])
                    @can ('delete', $row)
                        <a href="{{ route('users.delete', $row->id()) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('users.delete', $row->id()) }}'); return false;">
                            <i class="fa fa-trash"></i>@lang ('elements.words.delete')
                        </a>
                    @endcan
                @endcan
            @endif
        @endif

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
