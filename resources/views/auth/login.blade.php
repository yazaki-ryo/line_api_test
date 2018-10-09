@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.login') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">{{ config('app.name', 'Laravel') }}</h1>
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
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('elements.words.login') </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => route('login'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            <div class="form-group{{ $errors->has($attribute = 'email') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon-{{ $attribute }}">@</span>
                                        <input type="email" name="{{ $attribute }}" value="{{ old($attribute) }}" class="none-radius form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang('attributes.users.email')" aria-describedby="basic-addon-{{ $attribute }}" required autofocus />
                                    </div>

                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has($attribute = 'password') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon-{{ $attribute }}"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="none-radius form-control" placeholder="@lang('attributes.users.password')" required />
                                    </div>

                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox($attribute = 'remember', 1, old($attribute), []) !!} @lang (sprintf('attributes.users.%s', $attribute))
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn">
                                        @lang ('elements.words.login')
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> @lang ('Forgot Your Password?')
                                    </a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <P>SNSを表示させる</P>
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
