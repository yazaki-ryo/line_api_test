{!! Form::hidden(null, 'Japan', ['class' => 'p-country-name']) !!}

@set ($field1, 'last_name')
@set ($field2, 'first_name')
<div class="form-group{{ $errors->has($field1) || $errors->has($field2) ? ' has-error' : '' }}">
    <label for="{{ $field1 }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field1}")@lang ("attributes.customers.{$field2}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-3">
        {!! Form::text($field1, old($field1, request($field1, $row->{$camel = camel_case($field1)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field1, 'maxlength' => 191, 'placeholder' => __("attributes.customers.{$field1}")]) !!}
        {!! $errors->first($field1, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>

    <div class="col-md-3">
        {!! Form::text($field2, old($field2, request($field2, $row->{$camel = camel_case($field2)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field2, 'maxlength' => 191, 'placeholder' => __("attributes.customers.{$field2}")]) !!}
        {!! $errors->first($field2, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field1, 'last_name_kana')
@set ($field2, 'first_name_kana')
<div class="form-group{{ $errors->has($field1) || $errors->has($field2) ? ' has-error' : '' }}">
    <label for="{{ $field1 }}" class="col-md-4 control-label">
        @lang ("attributes.customers.last_name")@lang ("attributes.customers.{$field2}")
    </label>

    <div class="col-md-3">
        {!! Form::text($field1, old($field1, request($field1, $row->{$camel = camel_case($field1)}() ?? null)), ['class' => 'form-control', 'id' => $field1, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field1}")]) !!}
        {!! $errors->first($field1, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>

    <div class="col-md-3">
        {!! Form::text($field2, old($field2, request($field2, $row->{$camel = camel_case($field2)}() ?? null)), ['class' => 'form-control', 'id' => $field2, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field2}")]) !!}
        {!! $errors->first($field2, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'sex_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        @foreach ($sexes as $item)
            <label>
                <input type="radio" name="{{ $field }}" value="{{ $item->id() }}" {{ (int)old($field, request($field, $row->{$camel = camel_case($field)}() ?? 1)) === $item->id() ? 'checked' : '' }} /> <span class="text-{{ $item->id() === 1 ? 'info' : ($item->id() === 2 ? 'danger' : '') }}">{{ $item->name() }}</span>
            </label>
        @endforeach

        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'office')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'office_kana')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'department')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'position')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'postal_code')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="glyphicon glyphicon-question-sign text-warning" data-toggle="popover" data-content="@lang ('By entering the postal code, the prefecture city, town, village address is automatically entered.')"></span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control p-postal-code', 'id' => $field, 'maxlength' => 7, 'placeholder' => __('No hyphen, 7 numeric digits')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'prefecture_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::select($field, $prefectures->pluckNamesByIds(), old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control p-region-id', 'id' => $field, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'address')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control p-locality p-street-address', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'building')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'tel')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'fax')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'email')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::email($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'mobile_phone')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'birthday')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-3 form-control-static">
        {!! Form::tel($field, old($field, request($field, empty($row->{$camel = camel_case($field)}()) ? null : $row->{$camel = camel_case($field)}()->format('Y-m-d'))), ['class' => 'form-control', 'id' => $field, 'maxlength' => 10, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'anniversary')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-3 form-control-static">
        {!! Form::tel($field, old($field, request($field, empty($row->{$camel = camel_case($field)}()) ? null : $row->{$camel = camel_case($field)}()->format('Y-m-d'))), ['class' => 'form-control', 'id' => $field, 'maxlength' => 10, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'mourning_flag')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="0" required checked /> <span class="text-success">@lang ("elements.words.no")</span>
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="1" required {{ (bool)old($field, request($field, !empty($row->mournedAt()) ?? null)) === true ? 'checked' : '' }} /> <span class="text-danger">@lang ("elements.words.yes")</span>
        </label>
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'likes_and_dislikes')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'note')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => __("elements.placeholders.customers.{$field}")]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'store_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.words.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($field, $stores->pluckNamesByIds(), old($field, request($field, $row->{$camel = camel_case($field)}() ?? $user->{$camel}())), [$user->cant('roles', 'company-admin') ? 'readonly' : null, 'required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'cancel_cnt')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
        <label for="{{ $field }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$field}")
        </label>

        <div class="col-md-6 form-control-static">
            {{ optional($row->{$camel = camel_case($field)}())->asInt() ?? null }}
            {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
        </div>
    </div>
@endif

@set ($field, 'noshow_cnt')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
        <label for="{{ $field }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$field}")
        </label>

        <div class="col-md-6 form-control-static">
            {{ optional($row->{$camel = camel_case($field)}())->asInt() ?? null }}
            {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
        </div>
    </div>
@endif

@set ($field, 'updated_at')
@if ($mode === 'edit')
    <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
        <label for="{{ $field }}" class="col-md-4 control-label">
            @lang ("attributes.customers.{$field}")
        </label>

        <div class="col-md-6 form-control-static">
            {{ $row->{$camel = camel_case($field)}() ?? null }}
            {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
        </div>
    </div>
@endif

<hr>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            @can ('authorize', ['customers.*', 'customers.create'])
                <button type="submit" class="btn btn-primary">@lang ('elements.words.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', ['customers.*', 'customers.update'])
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.words.save')</button>
                @endcan
            @endcan

            @can ('authorize', ['customers.*', 'customers.delete'])
                @can ('delete', $row)
                    <a href="{{ route('customers.delete', $row->id()) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('customers.delete', $row->id()) }}'); return false;">
                        <i class="fa fa-trash"></i>@lang ('elements.words.delete')
                    </a>
                @endcan
            @endcan
        @endif
    </div>
</div>
