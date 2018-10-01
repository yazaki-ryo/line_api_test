{!! Form::hidden(null, 'Japan', ['class' => 'p-country-name']) !!}

@set ($attribute1, 'last_name')
@set ($attribute2, 'first_name')
<div class="form-group{{ $errors->has($attribute1) || $errors->has($attribute2) ? ' has-error' : '' }}">
    <label for="{{ $attribute1 }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute1}")@lang ("attributes.customers.{$attribute2}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::text($attribute1, old($attribute1, request($attribute1, $row->{$camel = camel_case($attribute1)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $attribute1, 'maxlength' => 191, 'placeholder' => __("attributes.customers.{$attribute1}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute1])
    </div>

    <div class="col-md-3">
        {!! Form::text($attribute2, old($attribute2, request($attribute2, $row->{$camel = camel_case($attribute2)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $attribute2, 'maxlength' => 191, 'placeholder' => __("attributes.customers.{$attribute2}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute2])
    </div>
</div>

@set ($attribute1, 'last_name_kana')
@set ($attribute2, 'first_name_kana')
<div class="form-group{{ $errors->has($attribute1) || $errors->has($attribute2) ? ' has-error' : '' }}">
    <label for="{{ $attribute1 }}" class="col-md-4 control-label">
        @lang ("attributes.customers.last_name")@lang ("attributes.customers.{$attribute2}")
    </label>

    <div class="col-md-3">
        {!! Form::text($attribute1, old($attribute1, request($attribute1, $row->{$camel = camel_case($attribute1)}() ?? null)), ['class' => 'form-control', 'id' => $attribute1, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute1}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute1])
    </div>

    <div class="col-md-3">
        {!! Form::text($attribute2, old($attribute2, request($attribute2, $row->{$camel = camel_case($attribute2)}() ?? null)), ['class' => 'form-control', 'id' => $attribute2, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute2}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute2])
    </div>
</div>

@set ($attribute, 'sex_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6 form-control-static">
        @foreach ($sexes as $item)
            <label>
                <input type="radio" name="{{ $attribute }}" value="{{ $item->id() }}" {{ (int)old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? 1)) === $item->id() ? 'checked' : '' }} /> <span class="text-{{ $item->id() === 1 ? 'info' : ($item->id() === 2 ? 'danger' : '') }}">{{ $item->name() }}</span>
            </label>
        @endforeach

        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'office')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'office_kana')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'department')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'position')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::text($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'postal_code')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('By entering the postal code, the prefecture city, town, village address is automatically entered.')"></span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control p-postal-code', 'id' => $attribute, 'maxlength' => 7, 'placeholder' => __('No hyphen, 7 numeric digits')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'prefecture_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, $prefectures->pluckNamesByIds(), old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control p-region-id', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'address')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control p-locality p-street-address', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'building')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'tel')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'fax')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'email')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::email($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'mobile_phone')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'birthday')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, empty($row->{$camel = camel_case($attribute)}()) ? null : $row->{$camel = camel_case($attribute)}()->format('Y-m-d'))), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 10, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'anniversary')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-3">
        {!! Form::tel($attribute, old($attribute, request($attribute, empty($row->{$camel = camel_case($attribute)}()) ? null : $row->{$camel = camel_case($attribute)}()->format('Y-m-d'))), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 10, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'mourning_flag')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6 form-control-static">
        <label>
            <input type="radio" name="{{ $attribute }}" value="0" required checked /> <span class="text-success">@lang ("elements.words.no")</span>
        </label>
        <label>
            <input type="radio" name="{{ $attribute }}" value="1" required {{ (bool)old($attribute, request($attribute, !empty($row->mournedAt()) ?? null)) === true ? 'checked' : '' }} /> <span class="text-danger">@lang ("elements.words.yes")</span>
        </label>
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'likes_and_dislikes')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'note')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($attribute, old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? null)), ['class' => 'form-control', 'id' => $attribute, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => __("elements.placeholders.customers.{$attribute}")]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'store_id')
<div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
    <label for="{{ $attribute }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$attribute}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($attribute, $stores->pluckNamesByIds(), old($attribute, request($attribute, $row->{$camel = camel_case($attribute)}() ?? $user->{$camel}())), [$user->cant('roles', 'company-admin') ? 'readonly' : null, 'required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191]) !!}
        @include ('components.form.err_msg', ['attribute' => $attribute])
    </div>
</div>

@set ($attribute, 'last_visited_at')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$attribute}")
        </label>

        <div class="col-md-6 form-control-static">
            {{ $visitedHistories->count() ? $visitedHistories->last()->visitedAt()->format('Y-m-d H:i') : '-' }}
            @include ('components.form.err_msg', ['attribute' => $attribute])
        </div>
    </div>
@endif


@set ($attribute, 'first_visited_at')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$attribute}")
        </label>

        <div class="col-md-6 form-control-static">
            {{ $visitedHistories->count() ? $visitedHistories->first()->visitedAt()->format('Y-m-d H:i') : '-' }}
            @include ('components.form.err_msg', ['attribute' => $attribute])
        </div>
    </div>
@endif

@set ($attribute, 'cancel_cnt')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$attribute}")
        </label>

        <div class="col-md-6 form-control-static">
            <span class="badge">{{ optional($row->{$camel = camel_case($attribute)}())->asInt() ?? null }}</span>
            @include ('components.form.err_msg', ['attribute' => $attribute])
        </div>
    </div>
@endif

@set ($attribute, 'noshow_cnt')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$attribute}")
        </label>

        <div class="col-md-6 form-control-static">
            <span class="badge">{{ optional($row->{$camel = camel_case($attribute)}())->asInt() ?? null }}</span>
            @include ('components.form.err_msg', ['attribute' => $attribute])
        </div>
    </div>
@endif

@set ($attribute, 'updated_at')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
        <label for="{{ $attribute }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$attribute}")
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
