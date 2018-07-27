@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.pages.config.company') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.pages.config.company') <small><code>@lang ('Sub text')</code></small></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                    <div class="panel-body">
                        {!! Form::open(['url' => route('config.company'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            @set ($field, 'name')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.companies.{$field}")
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
                                    @lang ("attributes.companies.{$field}")
                                    <span class="label label-danger">@lang ("elements.labels.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'postal_code')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.companies.{$field}")
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
                                    @lang ("attributes.companies.{$field}")
                                    <span class="label label-danger">@lang ("elements.labels.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::select($field, $prefectures->pluckNamesByIds(), old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => __('Please select')]) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'address')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.companies.{$field}")
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
                                    @lang ("attributes.companies.{$field}")
                                </label>

                                <div class="col-md-6">
                                    {!! Form::textarea($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 1000, 'rows' => 3, 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'tel')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.companies.{$field}")
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
                                    @lang ("attributes.companies.{$field}")
                                </label>

                                <div class="col-md-6">
                                    {!! Form::tel($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'email')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.companies.{$field}")
                                    <span class="label label-danger">@lang ("elements.labels.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::email($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'plan_id')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.companies.{$field}")
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text(null, $row->plan()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $field]) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'updated_at')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.companies.{$field}")
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
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript">
        //
    </script>
@endsection
