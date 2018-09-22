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

                            @set ($attribute, 'name')
                            <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$attribute}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::text($attribute, old($attribute), ['required', 'autofocus', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            @set ($attribute, 'email')
                            <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$attribute}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::email($attribute, old($attribute), ['required', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            @set ($attribute, 'password')
                            <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$attribute}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" required />
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            @set ($attribute, 'password_confirmation')
                            <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$attribute}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" required />
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
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
