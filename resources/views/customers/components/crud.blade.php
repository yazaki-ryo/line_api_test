<input type="hidden" value="Japan" class="p-country-name" />

<div class="form-group{{ $errors->has($attribute1 = 'last_name') || $errors->has($attribute2 = 'first_name') ? ' has-error' : '' }}">
    <label for="{{ $attribute1 }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute1))@lang (sprintf('attributes.customers.%s', $attribute2))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="text" name="{{ $attribute1 }}" value="{{ old($attribute1, $row->{$camel = camel_case($attribute1)}() ?? null) }}" class="form-control" id="{{ $attribute1 }}" maxlength="191" placeholder="@lang (sprintf('attributes.customers.%s', $attribute1))" required autofocus />
        @include ('components.form.err_msg', ['attribute' => $attribute1])
    </div>

    <div class="col-md-3">
        <input type="text" name="{{ $attribute2 }}" value="{{ old($attribute2, $row->{$camel = camel_case($attribute2)}() ?? null) }}" class="form-control" id="{{ $attribute2 }}" maxlength="191" placeholder="@lang (sprintf('attributes.customers.%s', $attribute2))" required />
        @include ('components.form.err_msg', ['attribute' => $attribute2])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute1 = 'last_name_kana') || $errors->has($attribute2 = 'first_name_kana') ? ' has-error' : '' }}">
    <label for="{{ $attribute1 }}" class="col-md-4 control-label">
        @lang ('attributes.customers.last_name')@lang (sprintf('attributes.customers.%s', $attribute2))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-3">
        <input type="text" name="{{ $attribute1 }}" value="{{ old($attribute1, $row->{$camel = camel_case($attribute1)}() ?? null) }}" class="form-control" id="{{ $attribute1 }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute1))" />
        @include ('components.form.err_msg', ['attribute' => $attribute1])
    </div>

    <div class="col-md-3">
        <input type="text" name="{{ $attribute2 }}" value="{{ old($attribute2, $row->{$camel = camel_case($attribute2)}() ?? null) }}" class="form-control" id="{{ $attribute2 }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute2))" />
        @include ('components.form.err_msg', ['attribute' => $attribute2])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'sex_id') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6 form-control-static">
        @foreach ($sexes as $item)
            <label>
                <input type="radio" name="{{ $attribute }}" value="{{ $item->id() }}" {{ (int)old($attribute, $row->{$camel = camel_case($attribute)}() ?? 1) === $item->id() ? 'checked' : '' }} /> <span class="text-{{ $item->id() === 1 ? 'info' : ($item->id() === 2 ? 'danger' : '') }}">{{ $item->name() }}</span>
            </label>
        @endforeach

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'office') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'office_kana') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'department') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'position') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'postal_code') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('By entering the postal code, the prefecture city, town, village address is automatically entered.')"></span>
    </label>

    <div class="col-md-6">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control p-postal-code" id="{{ $attribute }}" maxlength="7" placeholder="@lang ('No hyphen, 7 numeric digits')" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'prefecture_id') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <select name="{{ $attribute }}" class="form-control p-region-id" id="{{ $attribute }}">
            <option value>@lang ('Please select')</option>
            @foreach ($prefectures->pluckNamesByIds() as $key => $item)
                <option value="{{ $key }}" {{ (int)old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) === $key ? 'selected' : '' }} >{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'address') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control p-locality p-street-address" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))">{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'building') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))">{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'tel') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'fax') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'email') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="email" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'mobile_phone') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'birthday') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, empty($row->{$camel = camel_case($attribute)}()) ? null : $row->{$camel = camel_case($attribute)}()->format('Y-m-d')) }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'anniversary') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-3">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, empty($row->{$camel = camel_case($attribute)}()) ? null : $row->{$camel = camel_case($attribute)}()->format('Y-m-d')) }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'mourning_flag') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6 form-control-static">
        <label>
            <input type="radio" name="{{ $attribute }}" value="0" required checked /> <span class="text-success">@lang ('elements.words.no')</span>
        </label>
        <label>
            <input type="radio" name="{{ $attribute }}" value="1" required {{ (bool)old($attribute, request($attribute, !empty($row->mournedAt()) ?? null)) === true ? 'checked' : '' }} /> <span class="text-danger">@lang ('elements.words.yes')</span>
        </label>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'likes_and_dislikes') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="">{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'note') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="@lang (sprintf('elements.placeholders.customers.%s', $attribute))">{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'store_id') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.customers.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <select name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" {{ $user->cant('authorize', ['stores.select', 'own-company-stores.select']) ? 'disabled' : 'required' }}>
            <option value>@lang ('Please select')</option>
            @foreach ($stores->pluckNamesByIds() as $key => $item)
                <option value="{{ $key }}" {{ (int)old($attribute, $row->{$camel = camel_case($attribute)}() ?? $user->{$camel}()) === $key ? 'selected' : '' }}>{{ $item }}</option>
            @endforeach
        </select>

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'last_visited_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.customers.%s', $attribute))
        </label>

        <div class="col-md-6 form-control-static">
            {{ $visitedHistories->count() ? $visitedHistories->last()->visitedAt()->format('Y-m-d H:i') : '-' }}
        </div>
    </div>
@endif


@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'first_visited_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.customers.%s', $attribute))
        </label>

        <div class="col-md-6 form-control-static">
            {{ $visitedHistories->count() ? $visitedHistories->first()->visitedAt()->format('Y-m-d H:i') : '-' }}
        </div>
    </div>
@endif

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'cancel_cnt' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.customers.%s', $attribute))
        </label>

        <div class="col-md-6 form-control-static">
            <span class="badge">{{ optional($row->{$camel = camel_case($attribute)}())->asInt() ?? null }}</span>
        </div>
    </div>
@endif

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'noshow_cnt' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.customers.%s', $attribute))
        </label>

        <div class="col-md-6 form-control-static">
            <span class="badge">{{ optional($row->{$camel = camel_case($attribute)}())->asInt() ?? null }}</span>
        </div>
    </div>
@endif

@if ($mode === 'edit')
    <div class="form-group">
        <label for="{{ $attribute = 'updated_at' }}" class="col-md-4 control-label">
            @lang (sprintf('attributes.customers.%s', $attribute))
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
            @can ('authorize', config('permissions.groups.customers.create'))
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', config('permissions.groups.customers.update'))
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @can ('authorize', config('permissions.groups.customers.delete'))
                @can ('delete', $row)
                    <a href="{{ route('customers.delete', $row->id()) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('customers.delete', $row->id()) }}'); return false;">
                        <i class="fa fa-trash"></i>@lang ('elements.words.delete')
                    </a>
                @endcan
            @endcan
        @endif

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
