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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- ※後にsassへの移行時に以下メディアクエリCSS等も移行して要削除 --}}
    <style>
        body {
            font: 16px/1.6 "メイリオ", Meiryo, "ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", Osaka, "ＭＳ Ｐゴシック", "MS PGothic", Helvetica, Arial, Sans-Serif;
            animation: fadeIn 1.5s ease 0s 1 normal;
            -webkit-animation: fadeIn 1.5s ease 0s 1 normal;
        }

        .navbar-fixed-left {
          box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.4);
        }

        @media only screen and (min-width : 768px) {
            .dropdown:hover .dropdown-menu {
                display: block;
            }
        }

        @media (min-width:768px){.container{width:503px}}@media (min-width:992px){.container{width:723px}}@media (min-width:1200px){.container{width:923px}}@media (min-width:1432px){.container{width:1170px}}body{padding-top:70px}.navbar-fixed-left,.navbar-fixed-right{position:fixed;top:0;width:100%;z-index:1030}@media (min-width:768px){.navbar-fixed-left,.navbar-fixed-right{width:232px;height:100vh;border-radius:0}.navbar-fixed-left .container,.navbar-fixed-left .container-fluid,.navbar-fixed-right .container,.navbar-fixed-right .container-fluid{padding-right:0;padding-left:0;width:auto}.navbar-fixed-left .navbar-header,.navbar-fixed-right .navbar-header{float:none;padding-left:15px;padding-right:15px}.navbar-fixed-left .navbar-collapse,.navbar-fixed-right .navbar-collapse{padding-right:0;padding-left:0;max-height:none}.navbar-fixed-left .navbar-collapse .navbar-nav,.navbar-fixed-right .navbar-collapse .navbar-nav{float:none!important}.navbar-fixed-left .navbar-collapse .navbar-nav>li,.navbar-fixed-right .navbar-collapse .navbar-nav>li{width:100%}.navbar-fixed-left .navbar-collapse .navbar-nav>li.dropdown .dropdown-menu,.navbar-fixed-right .navbar-collapse .navbar-nav>li.dropdown .dropdown-menu{top:0}.navbar-fixed-left .navbar-collapse .navbar-nav.navbar-right,.navbar-fixed-right .navbar-collapse .navbar-nav.navbar-right{margin-right:0}}@media (min-width:768px){body{padding-top:0;margin-left:232px}.navbar-fixed-left{right:auto!important;left:0!important;border-width:0 1px 0 0!important}.navbar-fixed-left .dropdown .dropdown-menu{left:100%;right:auto;border-radius:0 3px 3px 0}.navbar-fixed-left .dropdown .dropdown-toggle .caret{border-top:4px solid transparent;border-left:4px solid;border-bottom:4px solid transparent;border-right:none}}

        @keyframes fadeIn {
            0% {opacity: 0}
            100% {opacity: 1}
        }

        @-webkit-keyframes fadeIn {
            0% {opacity: 0}
            100% {opacity: 1}
        }
    </style>
    {{-- ※ここまで --}}
</head>
<body>
    <div id="app">
        @include ('layouts.nav')

        @yield('content')

        @include ('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
