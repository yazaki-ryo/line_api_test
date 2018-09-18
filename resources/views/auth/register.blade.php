@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.user')@lang ('elements.words.register') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.user')@lang ('elements.words.register')
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
                        {!! Form::open(['url' => route('register'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            @set ($field, 'name')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$field}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text($field, old($field), ['required', 'autofocus', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'email')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$field}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::email($field, old($field), ['required', 'class' => 'form-control', 'id' => $field, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'password')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$field}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    <input name="{{ $field }}" type="password" id="{{ $field }}" class="form-control" required />
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            @set ($field, 'password_confirmation')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$field}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    <input name="{{ $field }}" type="password" id="{{ $field }}" class="form-control" required />
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang ('elements.words.register')
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
