@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.login') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12 content-wrapper">

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
                <div class="panel-login panel panel-default">
                    <div class="panel-heading"><i class="fas fa-sign-in-alt fa-lg"></i> @lang ('elements.words.login')</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => route('eka45iPLCVNEw4EANEMFh8sU'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'email') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon-{{ $attribute }}">@</span>
                                        <input type="email" name="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="none-radius form-control" id="{{ $attribute }}" maxlength="191" placeholder="@lang('attributes.users.email')" aria-describedby="basic-addon-{{ $attribute }}" required autofocus />
                                    </div>

                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon-{{ $attribute }}"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input name="{{ $attribute }}" type="password" value="" id="{{ $attribute }}" class="none-radius form-control" placeholder="@lang('attributes.users.password')" required />
                                    </div>

                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox($attribute = 'remember', 1, $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null) !!} @lang (sprintf('attributes.users.%s', $attribute))
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-submit-1 none-radius write">
                                        @lang ('elements.words.login')
                                    </button>

                                    <a class="btn-link btn-reset-link" href="{{ route('password.request') }}">
                                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> @lang ('Forgot Your Password?')
                                    </a>
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
