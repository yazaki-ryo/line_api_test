@auth
<nav class="navbar navbar-inverse navbar-fixed-left pt-30">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right nav-side">
                <!-- Authentication Links -->
                @auth
                    <!-- Customers -->
                    <li>
                        <a href="#side-nav1" class="dropdown-toggle" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            <i class="fas fa-address-book fa-lg"></i>
                            @lang ('elements.words.customers')@lang ('elements.words.management') <span class="caret"></span>
                        </a>
                        <div id="side-nav1" class="panel-collapse collapse">
                            <ul class="nav nav-child">
                                @can ('authorize', config('permissions.groups.customers.select'))
                                    <li class="{{ request()->route()->named('customers') ? 'active' : '' }}"><a href="{{ route('customers') }}">@lang ('elements.words.customers')@lang ('elements.words.list')</a></li>
                                @endcan

                                @can ('authorize', config('permissions.groups.customers.create'))
                                    <li class="{{ request()->route()->named('customers.files.import') ? 'active' : '' }} disabled"><a href="#{{-- route('customers.files.import') --}}">@lang ('elements.words.import')</a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <!-- Reservations -->
                    <li>
                        <a href="#side-nav-reservations" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            <i class="far fa-calendar-alt fa-lg"></i>
                            @lang ('elements.words.reservations')@lang ('elements.words.management') <span class="caret"></span>
                        </a>

                        <div id="side-nav-reservations" class="panel-collapse collapse">
                            <ul class="nav nav-child">
                                @can ('authorize', config('permissions.groups.tags.select')){{-- TODO Permissions --}}
                                    <li class="{{ request()->route()->named('reservations') ? 'active' : '' }}"><a href="{{ route('reservations') }}">@lang ('elements.words.reservations')@lang ('elements.words.list')</a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <!-- Stores -->
                    <li>
                        <a href="#side-nav2" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            <i class="fas fa-store"></i>
                            @lang ('elements.words.store')@lang ('elements.words.management') <span class="caret"></span>
                        </a>
                        <div id="side-nav2" class="panel-collapse collapse">
                            <ul class="nav nav-child">
                                <!-- Users -->
                                @can ('authorize', ['stores.select', 'own-company-stores.select'])
                                    <li class="dropdown-submenu {{ ! app()->isLocal() ? 'disabled' : '' }}">
                                        <a href="#" class="dropdown-toggle {{ ! app()->isLocal() ? 'disabled' : '' }}" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            @lang ('elements.words.users')@lang ('elements.words.management') <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu">
                                            @can ('authorize', config('permissions.groups.users.select'))
                                                <li class="{{ request()->route()->named('users') ? 'active' : '' }}"><a href="{{ route('users') }}">@lang ('elements.words.users')@lang ('elements.words.list')</a></li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan

                                <!-- Tags -->
                                <li>
                                    <a href="#side-nav2-child1" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        @lang ('elements.words.tags')@lang ('elements.words.management') <span class="caret"></span>
                                    </a>

                                    <div id="side-nav2-child1" class="panel-collapse collapse">
                                        <ul class="nav nav-child">
                                            @can ('authorize', config('permissions.groups.tags.select'))
                                                <li class="{{ request()->route()->named('tags') ? 'active' : '' }}"><a href="{{ route('tags') }}">@lang ('elements.words.tags')@lang ('elements.words.list')</a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>

                                <!-- Menus -->
                                <li class="disabled">
                                    <a href="#" class="disabled" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        @lang ('elements.words.menus')@lang ('elements.words.management') <span class="caret"></span>
                                    </a>
                                </li>

                                <!-- Surveys -->
                                <li class="disabled">
                                    <a href="#" class="disabled" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        @lang ('elements.words.surveys')@lang ('elements.words.management') <span class="caret"></span>
                                    </a>
                                </li>

                                <!-- Coupons -->
                                <li class="disabled">
                                    <a href="#" class="disabled" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        @lang ('elements.words.coupons')@lang ('elements.words.management') <span class="caret"></span>
                                    </a>
                                </li>

                                <!-- Own store -->
                                @can ('authorize', config('permissions.groups.stores.update'))
                                    <li class="{{ request()->route()->named('settings.store') ? 'active' : '' }}"><a href="{{ route('settings.store') }}">@lang ('elements.words.store')@lang ('elements.words.information')</a></li>
                                @endcan

                                <!-- Own company stores -->
                                @can ('authorize', ['stores.select', 'own-company-stores.select'])
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            @lang ('elements.words.stores')@lang ('elements.words.toggle') <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu">
                                            @foreach ($stores as $store)
                                                <li><a href="{{ route('home', ['store_id' => $store->id()]) }}">{{ $store->name() }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>

                    <!-- Settings -->
                    <li>
                        <a href="#side-nav3" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            <i class="fas fa-cogs"></i>
                            @lang ('elements.words.various')@lang ('elements.words.settings') @if ($unreadNotifications->count()) <span class="badge bg-danger">{{ $unreadNotifications->count() }}</span> @endif <span class="caret"></span>
                        </a>

                        <div id="side-nav3" class="panel-collapse collapse">
                            <ul class="nav nav-child">
                                <!-- My profile -->
                                <li class="{{ request()->route()->named('settings.profile') ? 'active' : '' }}"><a href="{{ route('settings.profile') }}">@lang ('elements.words.user')@lang ('elements.words.information')</a></li>

                                <!-- Own company -->
                                @can ('authorize', config('permissions.groups.companies.update'))
                                    <li class="{{ request()->route()->named('settings.company') ? 'active' : '' }}"><a href="{{ route('settings.company') }}">@lang ('elements.words.company')@lang ('elements.words.information')</a></li>
                                @endcan

                                <li class="disabled"><a href="#">@lang ('elements.words.notification') @if ($unreadNotifications->count()) <span class="badge bg-danger">{{ $unreadNotifications->count() }}</span> @endif </a></li>

                                <!-- Various settings -->
                                <li>
                                    <a href="#side-nav3-child2" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        @lang ('elements.words.settings') <span class="caret"></span>
                                    </a>

                                    <div id="side-nav3-child2" class="panel-collapse collapse">
                                        <ul class="nav nav-child">
                                            @can ('authorize', 'self-settings.printings.update')
                                                <li class="{{ request()->route()->named('settings.printings') ? 'active' : '' }}"><a href="{{ route('settings.printings') }}">@lang ('elements.words.print')@lang ('elements.words.settings')</a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>

                                <li role="separator" class="divider"></li>

                                <li>
                                    <a href="{{ route('logout') }}" onclick="common.submitFormWithConfirm('{{ route('logout') }}', '@lang ('Do you want to log out?')'); return false;">
                                        <i class="fa fa-sign-out pull-right"></i>@lang ('elements.words.logout')
                                    </a>
                                </li>
                            </ul>
                        </div>
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
@endauth
