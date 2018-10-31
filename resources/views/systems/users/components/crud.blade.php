<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'name') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.users.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required {{ $mode === 'edit' ? 'disabled' : 'autofocus' }} />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'email') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.users.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="email" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required {{ $mode === 'edit' ? 'disabled' : '' }} />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'company_id') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.users.%s', $attribute))
    </label>

    <div class="col-md-6 form-control-static">
        {{ optional($row->company())->name() ?? optional($user->company())->name() }}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'role') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.users.%s', $attribute))
        @if ($mode === 'add' || $mode === 'edit') <span class="label label-danger">@lang ('elements.words.required')</span> @endif
    </label>

    <div class="col-md-6">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" {{ ($mode === 'profile') || ($user->id() === $row->id()) || $user->cant('authorize', config('permissions.groups.users.create')) ? 'disabled' : 'required' }}>
            <option value>@lang ('Please select')</option>
            @foreach (config('permissions.roles.general') as $key => $item)
                <option value="{{ $key }}" {{ old($attribute, empty($row->role()) ? $user->role() : $row->role()) === $key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

{{-- // TODO permissions --}}

@env ('local')
    @if ($mode === 'profile')
        <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'avatar') ? ' has-error' : '' }}">
            <label for="{{ $attribute }}" class="col-md-4 control-label">
                @lang (sprintf('attributes.users.%s', $attribute))
            </label>

            <div class="col-md-6 form-control-static">
                @include ('users.components.avatars')

                <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /><!-- TODO from config file. -->
                {!! Form::file($attribute, null, ['class' => 'form-control', 'id' => $attribute, 'placeholder' => '']) !!}
                @include ('components.form.err_msg', ['attribute' => $attribute])

                @if ($row->avatars()->count())
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox($attribute2 = 'drop_avatar', 1, old($attribute2), ['class' => '', 'id' => $attribute2]) !!} @lang ('Delete the current image.')
                        </label>

                        @include ('components.form.err_msg', ['attribute' => $attribute2])
                    </div>
                @endif
            </div>
        </div>
    @endif
@endenv

@if ($mode === 'add' || $mode === 'profile')
    <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'password') ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.users.%s', $attribute))

            @if ($mode === 'add') <span class="label label-danger">@lang ('elements.words.required')</span> @endif
        </label>

        <div class="col-md-6">
            <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" placeholder="{{ $mode === 'edit' || $mode === 'profile' ? __('Please input only when changing.') : '' }}" {{ $mode === 'add' ? 'required' : '' }} />
            @include ('components.form.err_msg', ['attribute' => $attribute])
        </div>
    </div>

    <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'password_confirmation') ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.users.%s', $attribute))

            @if ($mode === 'add') <span class="label label-danger">@lang ('elements.words.required')</span> @endif
        </label>

        <div class="col-md-6">
            <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" placeholder="{{ $mode === 'edit' || $mode === 'profile' ? __('Please re-enter for confirmation.') : '' }}" {{ $mode === 'add' ? 'required' : '' }} />
            @include ('components.form.err_msg', ['attribute' => $attribute])
        </div>
    </div>
@endif

@if ($mode === 'edit' || $mode === 'profile')
    <div class="form-group">
        <label for="{{ $attribute = 'updated_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.users.%s', $attribute))
        </label>

        <div class="col-md-6 form-control-static">
            {{ $row->{$camel = camel_case($attribute)}() ?? null }}
        </div>
    </div>
@endif

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            @can ('authorize', config('permissions.groups.users.create'))
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit' || $mode === 'profile')
            @can ('authorize', config('permissions.groups.users.update'))
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @if ($mode === 'edit')
                @can ('authorize', config('permissions.groups.users.delete'))
                    @can ('delete', $row)
                        <a href="{{ route('users.delete', $row->id()) }}" class="btn btn-danger" onclick="common.submitFormWithConfirm('{{ route('users.delete', $row->id()) }}'); return false;">
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
