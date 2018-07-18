@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.pages.user-profile') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1>@lang ('elements.pages.user-profile') <small><code>@lang ('Sub text')</code></small></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                    <div class="panel-body">
                        {!! Form::open(['url' => route('register'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            @set ($field, 'name')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.auth.{$field}")
                                    <span class="label label-danger">@lang ("elements.labels.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'autofocus', 'class' => 'form-control', 'id' => $field, 'maxlength' => '191', 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'email')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.auth.{$field}")
                                    <span class="label label-danger">@lang ("elements.labels.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::email($field, old($field, request($field, $row->{$camel = camel_case($field)}() ?? null)), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => '191', 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'company_id')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.auth.{$field}")
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text(null, $row->company()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $field]) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'store_id')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.auth.{$field}")
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text(null, $row->store()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $field]) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'role_id')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.auth.{$field}")
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text(null, $row->role()->name() ?? null, ['readonly', 'class' => 'form-control', 'id' => $field]) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'code')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.auth.{$field}")
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text(null, $row->{$camel = camel_case($field)}() ?? null, ['readonly', 'class' => 'form-control', 'id' => $field]) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'password')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">@lang ("attributes.auth.{$field}")</label>

                                <div class="col-md-6">
                                    <input name="{{ $field }}" type="password" id="{{ $field }}" class="form-control" placeholder="@lang ('Please input only when changing.')" />
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'password_confirmation')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">@lang ("attributes.auth.{$field}")</label>

                                <div class="col-md-6">
                                    <input name="{{ $field }}" type="password" id="{{ $field }}" class="form-control" placeholder="@lang ('Please re-enter for confirmation.')" />
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'updated_at')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.auth.{$field}")
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
