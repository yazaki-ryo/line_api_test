@set ($field, 'name')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'autofocus', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'kana')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
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

@set ($field, 'age')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'office')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'department')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'position')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'postal_code')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'prefecture_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::select($field, $prefectures->pluckNamesByIds(), old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'address')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'building_name')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'tel')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'fax')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'email')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::email($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'mobile_phone')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'mourning_flag')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6 form-control-static">
        <label>
            <input type="radio" name="{{ $field }}" value="0" required {{ (bool)old($field, request($field, optional($row->{$camel = camel_case($field)}())->asBoolean() ?? null)) === false ? 'checked' : '' }} /> <span class="text-success">@lang ("elements.labels.no")</span>
        </label>
        <label>
            <input type="radio" name="{{ $field }}" value="1" required {{ (bool)old($field, request($field, optional($row->{$camel = camel_case($field)}())->asBoolean() ?? null)) === true ? 'checked' : '' }} /> <span class="text-danger">@lang ("elements.labels.yes")</span>
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
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'store_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($field, $stores->pluckNamesByIds(), old($field, request($field, $row->{$camel = camel_case($field)}() ?? auth()->user()->{$camel})), [auth()->user()->cant('roles', 'company-admin') ? 'readonly' : null, 'required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'visited_cnt')
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

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        @if ($mode === 'add')
            @can ('authorize', ['customers.*', 'customers.create'])
                <button type="submit" class="btn btn-primary">@lang ('elements.actions.register')</button>
            @endcan
        @elseif ($mode === 'edit')
            @can ('authorize', ['customers.*', 'customers.update'])
                @can ('update', $row)
                    <button type="submit" class="btn btn-primary">@lang ('elements.actions.save')</button>
                @endcan
            @endcan

            @can ('authorize', ['customers.*', 'customers.delete'])
                @can ('delete', $row)
                    <a href="{{ route('customers.delete', $row->id()) }}" class="btn btn-danger" onclick="deleteRecord('{{ route('customers.delete', $row->id()) }}'); return false;">
                        <i class="fa fa-trash"></i>@lang ('elements.actions.delete')
                    </a>
                @endcan
            @endcan
        @endif
    </div>
</div>
