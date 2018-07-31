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
            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.labels.notice')</p>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.resources.customers')@lang ('elements.labels.information')</p>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.resources.stores')@lang ('elements.labels.information')</p>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.resources.users')@lang ('elements.labels.information')</p>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-0">
                <div class="well" style="height:220px;overflow:auto;">
                    <p class="lead">■@lang ('elements.resources.companies')@lang ('elements.labels.information')</p>
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
