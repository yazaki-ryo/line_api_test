@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1>@lang ('elements.buttons.password-reminder') <small><code>サブテキスト</code></small></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        {!! Form::open(['url' => route('password.email'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            @set ($field, 'email')
                            <div class="form-group{{ $errors->has($field) ? ' has-error' : '' }}">
                                <label for="{{ $field }}" class="col-md-4 control-label">@lang ("attributes.auth.{$field}")</label>

                                <div class="col-md-6">
                                    {!! Form::email($field, old($field), ['required', 'autofocus', 'class' => 'form-control', 'id' => $field, 'maxlength' => '191', 'placeholder' => '']) !!}
                                    {!! $errors->first($field, '<span class="glyphicon glyphicon-remove form-control-feedback"></span><span class="help-block"><strong>:message</strong></span>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang ('elements.buttons.submit')
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
