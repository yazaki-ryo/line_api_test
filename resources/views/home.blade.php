@extends('layouts.app')

@section('meta')
    <title>@lang ('elements.pages.home') | {{ config('app.name') }}</title>
    <meta name="description" content="@lang ('Test text...')" />
    <meta name="keywords" content="@lang ('Test text...')" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="page-header">
                    	<h1 class="h2">@lang ('elements.pages.home') <small><code>@lang ('Sub text')</code></small></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @include ('components.parts.alerts')
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-0">
                <div class="well">
                    <h2>@lang ('elements.menus.customers')</h2>
                    <p><code>@lang ('Test text...')</code></p>

                    <span class="label label-default">Default</span>
                    <span class="label label-primary">Primary</span>
                    <span class="label label-success">Success</span>
                    <span class="label label-info">Info</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="well">
                    <h2>@lang ('elements.menus.reservations')</h2>
                    <p><code>@lang ('Test text...')</code></p>

                    <span class="label label-default">Default</span>
                    <span class="label label-primary">Primary</span>
                    <span class="label label-success">Success</span>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="well">
                    <h2>@lang ('elements.menus.tags')</h2>
                    <p><code>@lang ('Test text...')</code></p>

                    <span class="label label-info">Info</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="well">
                    <h2>@lang ('elements.menus.menus')</h2>
                    <p><code>@lang ('Test text...')</code></p>

                    <span class="label label-default">Default</span>
                    <span class="label label-primary">Primary</span>
                    <span class="label label-success">Success</span>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="well">
                    <h2>@lang ('elements.menus.surveys')</h2>
                    <p><code>@lang ('Test text...')</code></p>

                    <span class="label label-info">Info</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="well">
                    <h2>@lang ('elements.menus.coupons')</h2>
                    <p><code>@lang ('Test text...')</code></p>

                    <span class="label label-default">Default</span>
                    <span class="label label-primary">Primary</span>
                    <span class="label label-success">Success</span>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0">
                <div class="well">
                    <h2>@lang ('elements.menus.configurations')</h2>
                    <p><code>@lang ('Test text...')</code></p>

                    <span class="label label-info">Info</span>
                    <span class="label label-warning">Warning</span>
                    <span class="label label-danger">Danger</span>
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
