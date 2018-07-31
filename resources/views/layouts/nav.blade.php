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
                            <i class="fa fa-sign-in"></i>@lang ('elements.pages.auth.login')
                        </a>
                    </li>

{{--
                    <li>
                        <a href="{{ route('register') }}">
                            <i class="fa fa-sign-in"></i>@lang ('elements.pages.auth.register')
                        </a>
                    </li>
--}}
                @else
                    <li class="dropdown-header">
                        @lang ('Welcome, :name.', ['name' => auth()->user()->name])
                    </li>

                    <!-- Customers menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.menus.customers') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            @can ('authorize', ['customers.*', 'customers.select'])
                                <li class="{{ request()->route()->named('customers') ? 'active' : '' }}"><a href="{{ route('customers') }}">@lang ('elements.pages.customers.index')</a></li>
                            @endcan

                            @can ('authorize', ['customers.*', 'customers.create'])
                                <li class="{{ request()->route()->named('customers.add') ? 'active' : '' }}"><a href="{{ route('customers.add') }}">@lang ('elements.pages.customers.add')</a></li>
                            @endcan
                        </ul>
                    </li>

                    <!-- Reservations menu -->
                    <li class="dropdown disabled">
                        <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.menus.reservations') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">test</a></li>
                        </ul>
                    </li>

                    <!-- Tags menu -->
                    <li class="dropdown disabled">
                        <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.menus.tags') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">test</a></li>
                        </ul>
                    </li>

                    <!-- Menus menu -->
                    <li class="dropdown disabled">
                        <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.menus.menus') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">test</a></li>
                        </ul>
                    </li>

                    <!-- Surveys menu -->
                    <li class="dropdown disabled">
                        <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.menus.surveys') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">test</a></li>
                        </ul>
                    </li>

                    <!-- Coupons menu -->
                    <li class="dropdown disabled">
                        <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.menus.coupons') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">test</a></li>
                        </ul>
                    </li>

                    <!-- Configurations menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.menus.configurations') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="disabled"><a href="#">@lang ('elements.actions.set')</a></li>
                            <li class="{{ request()->route()->named('configurations.profile') ? 'active' : '' }}"><a href="{{ route('configurations.profile') }}">@lang ('elements.pages.configurations.profile')</a></li>

                            @can ('authorize', ['users.*', 'users.select'])
                                <li class="{{ request()->route()->named('configurations.company') ? 'active' : '' }}"><a href="{{ route('configurations.company') }}">@lang ('elements.pages.configurations.company')</a></li>
                            @endcan

                            <li role="separator" class="divider"></li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('@lang ('Do you want to log out?')')) document.getElementById('logout-form').submit(); return false;">
                                    <i class="fa fa-sign-out pull-right"></i>@lang ('elements.pages.auth.logout')
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
