<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @if (file_exists(public_path('mix-manifest.json')))
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/default.css') }}" rel="stylesheet">
    @endif

    @include('components.google.analytics')
</head>
<body>
    <div id="app">
        @include ('layouts.nav')

        @yield('content')

        @include ('layouts.footer')
    </div>

    <!-- Scripts -->
    @if (file_exists(public_path('mix-manifest.json')))
        <script type="text/javascript" src="{{ mix('js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    @else
        <script type="text/javascript" src="{{ asset('js/default.js') }}"></script>
    @endif

    @yield('scripts')
</body>
</html>
