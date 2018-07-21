<nav class="navbar navbar-inverse navbar-fixed-left">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
{{--
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
--}}
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li>
                        <a href="{{ route('login') }}">
                            <i class="fa fa-sign-in"></i>@lang ('elements.pages.login')
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">
                            <i class="fa fa-sign-in"></i>@lang ('elements.pages.register-user')
                        </a>
                    </li>
                @else
                    <li class="dropdown-header">
                        ようこそ {{ auth()->user()->name }} さん
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            顧客管理 <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">test</a></li>
                            <li><a href="#">test</a></li>
                            <li><a href="#">test</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            予約管理 <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">test</a></li>
                            <li><a href="#">test</a></li>
                            <li><a href="#">test</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            各種設定 <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">設定</a></li>
                            <li><a href="{{ route('config.profile') }}">@lang ('elements.pages.config.profile')</a></li>
                            <li><a href="{{ route('config.company') }}">@lang ('elements.pages.config.company')</a></li>

                            <li role="separator" class="divider"></li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('ログアウトしますか？')) document.getElementById('logout-form').submit(); return false;">
                                    <i class="fa fa-sign-out pull-right"></i>@lang ('elements.pages.logout')
                                </a>

                                {{ Form::open(['id' => 'logout-form', 'url' => route('logout'), 'method' => 'post', 'style' => 'display: none;']) }}{{ Form::close() }}
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
