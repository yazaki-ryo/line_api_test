<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    @if (file_exists(public_path('mix-manifest.json')))
        <link href="{{ mix('css/systems.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/default.css') }}" rel="stylesheet">
    @endif

    @yield('styles')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="app">
        @include ('systems.layouts.nav')

        @yield('content')

        @include ('systems.layouts.footer')
    </div>

    {!! Form::open(['id' => 'basic-form', 'url' => '', 'method' => 'post', 'style' => 'display: none;']) !!}{!! Form::close() !!}

    <!-- Scripts -->
    @if (file_exists(public_path('mix-manifest.json')))
        <script type="text/javascript" src="{{ mix('js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/systems.js') }}"></script>
    @else
        <script type="text/javascript" src="{{ asset('js/default.js') }}"></script>
    @endif

    @yield('scripts')
</body>
</html>
