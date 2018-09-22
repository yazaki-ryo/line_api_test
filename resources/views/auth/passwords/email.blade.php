@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.passwords')@lang ('elements.words.reminder') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.passwords')@lang ('elements.words.reminder')
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        {!! Form::open(['url' => route('password.email'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            @set ($attribute, 'email')
                            <div class="form-group{{ $errors->has($attribute) ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang ("attributes.users.{$attribute}")
                                    <span class="label label-danger">@lang ("elements.words.required")</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::email($attribute, old($attribute), ['required', 'autofocus', 'class' => 'form-control', 'id' => $attribute, 'maxlength' => 191, 'placeholder' => '']) !!}
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang ('elements.words.submit')
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
