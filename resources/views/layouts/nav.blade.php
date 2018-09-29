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
            <a class="navbar-brand" href="{{ route('home') }}">
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
                            <i class="fa fa-sign-in"></i>@lang ('elements.words.login')
                        </a>
                    </li>

                    @if (\Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">
                                <i class="fa fa-sign-in"></i>@lang ('elements.words.user')@lang ('elements.words.register')
                            </a>
                        </li>
                    @endif
                @else
                    <li class="dropdown-header">
                        @lang ('Welcome, :name.', ['name' => $user->name()])
                    </li>

                    <!-- Customers -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.words.customers')@lang ('elements.words.management') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            @can ('authorize', config('permissions.groups.customers.select'))
                                <li class="{{ request()->route()->named('customers') ? 'active' : '' }}"><a href="{{ route('customers') }}">@lang ('elements.words.customers')@lang ('elements.words.list')</a></li>
                            @endcan

                            @can ('authorize', config('permissions.groups.customers.create'))
                                <li class="{{ request()->route()->named('customers.add') ? 'active' : '' }}"><a href="{{ route('customers.add') }}">@lang ('elements.words.customers')@lang ('elements.words.register')</a></li>
                            @endcan

                            @can ('authorize', config('permissions.groups.customers.create'))
                                <li class="{{ request()->route()->named('customers.files.import') ? 'active' : '' }} disabled"><a href="#{{-- route('customers.files.import') --}}">@lang ('elements.words.import')</a></li>
                            @endcan
                        </ul>
                    </li>

                    <!-- Reservations -->
                    <li class="dropdown disabled">
                        <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.words.reservations')@lang ('elements.words.management') <span class="caret"></span>
                        </a>
                    </li>

                    <!-- Stores -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.words.store')@lang ('elements.words.management') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <!-- Tags -->
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.tags')@lang ('elements.words.management') <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @can ('authorize', config('permissions.groups.tags.select'))
                                        <li class="{{ request()->route()->named('tags') ? 'active' : '' }}"><a href="{{ route('tags') }}">@lang ('elements.words.tags')@lang ('elements.words.list')</a></li>
                                    @endcan

                                    @can ('authorize', config('permissions.groups.tags.create'))
                                        <li class="{{ request()->route()->named('tags.add') ? 'active' : '' }}"><a href="{{ route('tags.add') }}">@lang ('elements.words.tags')@lang ('elements.words.register')</a></li>
                                    @endcan
                                </ul>
                            </li>

                            <!-- Menus -->
                            <li class="dropdown-submenu disabled">
                                <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.menus')@lang ('elements.words.management') <span class="caret"></span>
                                </a>
                            </li>

                            <!-- Surveys -->
                            <li class="dropdown-submenu disabled">
                                <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.surveys')@lang ('elements.words.management') <span class="caret"></span>
                                </a>
                            </li>

                            <!-- Coupons -->
                            <li class="dropdown-submenu disabled">
                                <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.coupons')@lang ('elements.words.management') <span class="caret"></span>
                                </a>
                            </li>

                            <!-- Own store -->
                            @can ('authorize', config('permissions.groups.stores.update'))
                                <li class="{{ request()->route()->named('settings.store') ? 'active' : '' }}"><a href="{{ route('settings.store') }}">@lang ('elements.words.store')@lang ('elements.words.information')@lang ('elements.words.edit')</a></li>
                            @endcan
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.words.various')@lang ('elements.words.settings') @if ($unreadNotifications->count()) <span class="badge bg-danger">{{ $unreadNotifications->count() }}</span> @endif <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <!-- Users -->
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.users')@lang ('elements.words.management') <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @can ('authorize', config('permissions.groups.users.select'))
                                        <li class="{{ request()->route()->named('users') ? 'active' : '' }}"><a href="{{ route('users') }}">@lang ('elements.words.users')@lang ('elements.words.list')</a></li>
                                    @endcan

                                    @can ('authorize', config('permissions.groups.users.create'))
                                        <li class="{{ request()->route()->named('users.add') ? 'active' : '' }}"><a href="{{ route('users.add') }}">@lang ('elements.words.users')@lang ('elements.words.register')</a></li>
                                    @endcan
                                </ul>
                            </li>

                            <!-- My profile -->
                            <li class="{{ request()->route()->named('settings.profile') ? 'active' : '' }}"><a href="{{ route('settings.profile') }}">@lang ('elements.words.user')@lang ('elements.words.information')@lang ('elements.words.edit')</a></li>

                            <!-- Own company -->
                            @can ('authorize', config('permissions.groups.companies.update'))
                                <li class="{{ request()->route()->named('settings.company') ? 'active' : '' }}"><a href="{{ route('settings.company') }}">@lang ('elements.words.company')@lang ('elements.words.information')@lang ('elements.words.edit')</a></li>
                            @endcan

                            <li class="disabled"><a href="#">@lang ('elements.words.notification') @if ($unreadNotifications->count()) <span class="badge bg-danger">{{ $unreadNotifications->count() }}</span> @endif </a></li>

                            <!-- Various settings -->
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.settings') <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @can ('authorize', ['self-settings.printings.update'])
                                        <li class="{{ request()->route()->named('settings.printings') ? 'active' : '' }}"><a href="{{ route('settings.printings') }}">@lang ('elements.words.print')@lang ('elements.words.settings')</a></li>
                                    @endcan
                                </ul>
                            </li>

                            <li role="separator" class="divider"></li>

                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('@lang ('Do you want to log out?')')) document.getElementById('logout-form').submit(); return false;">
                                    <i class="fa fa-sign-out pull-right"></i>@lang ('elements.words.logout')
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
