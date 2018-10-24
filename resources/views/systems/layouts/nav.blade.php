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
                @auth ('administrator')
                    <li class="dropdown-header">
                        @lang ('Welcome, :name.', ['name' => $user->name()])
                    </li>
@if (false)
                    <!-- Customers -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.words.customers')@lang ('elements.words.management') <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            @can ('authorize', config('permissions.groups.customers.select'))
                                <li class="{{ request()->route()->named('customers') ? 'active' : '' }}"><a href="{{ route('customers.index') }}">@lang ('elements.words.customers')@lang ('elements.words.list')</a></li>
                            @endcan

                            @can ('authorize', config('permissions.groups.customers.create'))
                                <li class="{{ request()->route()->named('customers.add') ? 'active' : '' }}"><a href="{{ route('customers.add') }}">@lang ('elements.words.customers')@lang ('elements.words.register')</a></li>
                            @endcan

                            @can ('authorize', config('permissions.groups.customers.create'))
                                <li class="{{ request()->route()->named('customers.files.import') ? 'active' : '' }} disabled"><a href="#{{-- route('customers.files.import') --}}">@lang ('elements.words.import')</a></li>
                            @endcan
                        </ul>
                    </li>
@endif

                    <!-- Settings -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            @lang ('elements.words.various')@lang ('elements.words.settings') <span class="badge bg-danger">0</span><span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
@if (false)
                            <!-- Users -->
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.users')@lang ('elements.words.management') <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @can ('authorize', config('permissions.groups.users.select'))
                                        <li class="{{ request()->route()->named('users') ? 'active' : '' }}"><a href="{{ route('users.index') }}">@lang ('elements.words.users')@lang ('elements.words.list')</a></li>
                                    @endcan

                                    @can ('authorize', config('permissions.groups.users.create'))
                                        <li class="{{ request()->route()->named('users.add') ? 'active' : '' }}"><a href="{{ route('users.add') }}">@lang ('elements.words.users')@lang ('elements.words.register')</a></li>
                                    @endcan
                                </ul>
                            </li>

                            <!-- My profile -->
                            <li class="{{ request()->route()->named('settings.profile') ? 'active' : '' }}"><a href="{{ route('settings.profile') }}">@lang ('elements.words.user')@lang ('elements.words.information')</a></li>

                            <!-- Own company -->
                            @can ('authorize', config('permissions.groups.companies.update'))
                                <li class="{{ request()->route()->named('settings.company') ? 'active' : '' }}"><a href="{{ route('settings.company') }}">@lang ('elements.words.company')@lang ('elements.words.information')</a></li>
                            @endcan

                            <li class="disabled"><a href="#">@lang ('elements.words.notification')</a></li>

                            <!-- Various settings -->
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    @lang ('elements.words.settings') <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    @can ('authorize', 'self-settings.printings.update')
                                        <li class="{{ request()->route()->named('settings.printings') ? 'active' : '' }}"><a href="{{ route('settings.printings') }}">@lang ('elements.words.print')@lang ('elements.words.settings')</a></li>
                                    @endcan
                                </ul>
                            </li>

                            <li role="separator" class="divider"></li>
@endif
                            <li>
                                <a href="{{ route('systems.logout') }}" onclick="common.submitFormWithConfirm('{{ route('systems.logout') }}', '@lang ('Do you want to log out?')'); return false;">
                                    <i class="fa fa-sign-out pull-right"></i>@lang ('elements.words.logout')
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
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
                @endauth
            </ul>
        </div>
    </div>
</nav>
