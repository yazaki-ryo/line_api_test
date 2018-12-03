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
                @include ('components.parts.any_errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                    <div class="panel-body">
                        {!! Form::open(['url' => route('systems.register'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                            <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'name') ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang (sprintf('attributes.users.%s', $attribute))
                                    <span class="label label-danger">@lang ('elements.words.required')</span>
                                </label>

                                <div class="col-md-6">
                                    <input type="text" name="{{ $attribute }}" value="{{ old($attribute) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required autofocus />
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'email') ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang (sprintf('attributes.users.%s', $attribute))
                                    <span class="label label-danger">@lang ('elements.words.required')</span>
                                </label>

                                <div class="col-md-6">
                                    <input type="email" name="{{ $attribute }}" value="{{ old($attribute) }}" class="form-control" id="{{ $attribute }}" maxlength="191" placeholder="" required />
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'password') ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang (sprintf('attributes.users.%s', $attribute))
                                    <span class="label label-danger">@lang ('elements.words.required')</span>
                                </label>

                                <div class="col-md-6">
                                    <input name="{{ $attribute }}" type="password" id="{{ $attribute }}" class="form-control" required />
                                    @include ('components.form.err_msg', ['attribute' => $attribute])
                                </div>
                            </div>

                            <div class="form-group{{ $errors->{$errorBag ?? 'default'}->has($attribute = 'password_confirmation') ? ' has-error' : '' }}">
                                <label for="{{ $attribute }}" class="col-md-4 control-label">
                                    @lang (sprintf('attributes.users.%s', $attribute))
                                    <span class="label label-danger">@lang ('elements.words.required')</span>
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

                                    <a href="javascript:history.back();" class="btn btn-default">
                                        @lang ('elements.words.back')
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
