@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.words.customers')@lang ('elements.words.register') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.words.customers')@lang ('elements.words.register') <small><code>@lang ('Sub text')</code></small></h1>
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
                        {!! Form::open(['url' => route('customers.add'), 'id' => '', 'method' => 'post', 'class' => 'form-horizontal h-adr']) !!}
                            @include ('customers.components.crud', ['mode' => 'add'])
                        {!! Form::close() !!}
                    </div>
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
