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
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'sex_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6 form-control-static">
        @foreach ($sexes as $item)
            {!! Form::radio($field, $item->id(), old($field, request($field, $row->sex()->id() ?? null)) == $item->id(), ['required', 'id' => '']) !!} {{ $item->name() }}
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
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'prefecture_id')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::select($field, $prefectures, old($field, request($field, $row->prefecture()->id() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'address')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
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
        <span class="label label-danger">@lang ("elements.labels.required")</span>
    </label>

    <div class="col-md-6">
        {!! Form::email($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
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
        {!! Form::radio($field, 0, true, ['required', 'id' => '']) !!} <span class="text-success">@lang ("elements.labels.no")</span>
        {!! Form::radio($field, 1, old($field, request($field, $row->{$camel = camel_case($field)}()->asBoolean() ?? null)) === true, ['required', 'id' => '']) !!} <span class="text-danger">@lang ("elements.labels.yes")</span>
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
    </label>

    <div class="col-md-6">
        {!! Form::text(null, $row->store()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $field]) !!}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'visited_cnt')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}()->asInt() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'cancel_cnt')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}()->asInt() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'noshow_cnt')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}()->asInt() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

@set ($field, 'updated_at')
<div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
    <label for="{{ $field }}" class="col-md-4 control-label">
        @lang ("attributes.customers.{$field}")
    </label>

    <div class="col-md-6 form-control-static">
        {{ $row->{$camel = camel_case($field)}() ?? null }}
        {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            @lang ('elements.buttons.save')
        </button>
    </div>
</div>
