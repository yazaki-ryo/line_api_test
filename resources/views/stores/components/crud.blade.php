<input type="hidden" value="Japan" class="p-country-name" />

<div class="form-group{{ $errors->has($attribute = 'name') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required autofocus />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'kana') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="text" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required autofocus />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'postal_code') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('By entering the postal code, the prefecture city, town, village address is automatically entered.')"></span>
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control p-postal-code" id="{{ $attribute }}" maxlength="7" placeholder="@lang ('No hyphen, 7 numeric digits')" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'prefecture_id') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, $prefectures->pluckNamesByIds(), old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control p-region-id', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'address') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control p-locality p-street-address" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="" required>{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'building') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
    </label>

    <div class="col-md-6">
        <textarea name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" maxlength="1000" rows="3" placeholder="">{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}</textarea>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'tel') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'fax') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
    </label>

    <div class="col-md-6">
        <input type="tel" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="10" placeholder="" />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group{{ $errors->has($attribute = 'email') ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
        <span class="label label-danger">@lang ('elements.words.required')</span>
    </label>

    <div class="col-md-6">
        <input type="email" name="{{ $attribute }}" value="{{ old($attribute, $row->{$camel = camel_case($attribute)}() ?? null) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

<div class="form-group">
    <label for="{{ $attribute = 'company_id' }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
    </label>

    <div class="col-md-6 form-control-static">
        {{ optional($row->company())->name() ?? null }}
    </div>
</div>

<div class="form-group">
    <label for="{{ $attribute = 'updated_at' }}" class="col-md-4 control-label">
        @lang (sprintf('attributes.stores.%s', $attribute))
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($attribute)}() ?? null }}
    </div>
</div>

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @can ('authorize', config('permissions.groups.stores.update'))
            <button type="submit" class="btn btn-primary">
                @lang ('elements.words.save')
            </button>
        @endcan

        <a href="javascript:history.back();" class="btn btn-default">
            @lang ('elements.words.back')
        </a>
    </div>
</div>
