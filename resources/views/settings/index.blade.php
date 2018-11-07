@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.user')@lang ('elements.words.information') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.user')@lang ('elements.words.information')
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
                <ul class="nav nav-tabs">
                    <li class="{{ \Util::activatable($errors, 'users_self_update_request', true) }}">
                        <a href="#user-tab" data-toggle="tab">
                            @lang ('elements.words.user')@lang ('elements.words.information')
                        </a>
                    </li>
                    @if ($store)
                        @can ('authorize', config('permissions.groups.stores.update'))
                            <li class="{{ \Util::activatable($errors, 'stores_update_request') }}">
                                <a href="#store-tab" data-toggle="tab">@lang ('elements.words.store')@lang ('elements.words.information')</a>
                            </li>
                        @endcan
                    @endif

                    @if ($company)
                        @can ('authorize', config('permissions.groups.companies.update'))
                            <li class="{{ \Util::activatable($errors, 'companies_update_request') }}">
                                <a href="#company-tab" data-toggle="tab">@lang ('elements.words.company')@lang ('elements.words.information')</a>
                            </li>
                        @endcan
                    @endif
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'users_self_update_request', true) }}" id="user-tab">
                        <div class="panel panel-default">
                            <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                            <div class="panel-body">
                                {!! Form::open(['url' => route('settings.profile.edit'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true]) !!}
                                    @include ('users.components.crud', ['row' => $user, 'errorBag' => 'users_self_update_request', 'mode' => 'profile'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                    @if ($store)
                        @can ('authorize', config('permissions.groups.stores.update'))
                            <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'stores_update_request') }}" id="store-tab">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                    <div class="panel-body">
                                        {!! Form::open(['url' => route('settings.store.edit'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr']) !!}
                                            @include ('stores.components.crud', ['row' => $store, 'errorBag' => 'stores_update_request'])
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endcan
                    @endif

                    @if ($company)
                        @can ('authorize', config('permissions.groups.companies.update'))
                            <div class="tab-pane fade in pt-10 {{ \Util::activatable($errors, 'companies_update_request') }}" id="company-tab">
                                <div class="panel panel-default">
                                    <div class="panel-heading"> @lang ('Please enter necessary items.') </div>

                                    <div class="panel-body">
                                        {!! Form::open(['url' => route('settings.company.edit'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr']) !!}
                                            @include ('companies.components.crud', ['row' => $company, 'errorBag' => 'companies_update_request'])
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('scripts')
    <script type="text/javascript" src="https://yubinbango.github.io/yubinbango/yubinbango.js"></script>
    <script type="text/javascript">
        //
    </script>
@endsection
