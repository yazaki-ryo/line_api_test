@auth
<nav id="nav-sidebar" class="navbar navbar-inverse navbar-fixed-left drawer-nav pt-30">
    <div class="container">
        {{-- <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div> --}}

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right nav-side">
                <!-- Authentication Links -->
                @auth
                    <li class="dropdown-header">
                        @lang ('Welcome, :name.', ['name' => $user->name()])
                    </li>

                    <li class="dropdown-header">
                        {{ optional($currentStore)->name() ?? null }}
                    </li>

                    <!-- Customers -->
                    <li>
                        <a href="#side-nav1" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            <i class="fas fa-address-book fa-lg"></i>
                            @lang ('elements.words.customers')@lang ('elements.words.management') <span class="caret"></span>
                        </a>
                        <div id="side-nav1" class="panel-collapse collapse">
                            <ul class="nav nav-child">
                                @can ('authorize', config('permissions.groups.customers.select'))
                                    <li class="{{ request()->route()->named('customers') ? 'active' : '' }}"><a href="{{ route('customers.index', ['tab' => 'customers_search_request']) }}">@lang ('elements.words.customers')@lang ('elements.words.list')</a></li>
                                @endcan
                                @can ('authorize', config('permissions.groups.customers.postcards.export'))
                                    <li class="{{ request()->route()->named('customers') ? 'active' : '' }}"><a href="{{ route('customers.magazines.index') }}">@lang ('elements.words.customers')@lang ('elements.words.mail_history')</a></li>
                                @endcan
                                {{--
                                @can ('authorize', config('permissions.groups.customers.create'))
                                    <li class="{{ request()->route()->named('customers.files.import') ? 'active' : '' }} disabled"><a href="# route('customers.files.import')">@lang ('elements.words.import')</a></li>
                                @endcan
                                --}}
                            </ul>
                        </div>
                    </li>

                    <!-- Reservations -->
                    <li class="{{ \Route::has('reservations.index') ? '' : 'disabled' }}"><!-- TODO -->
                        <a href="#side-nav-reservations" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            <i class="far fa-calendar-alt fa-lg"></i>
                            @lang ('elements.words.reservations')@lang ('elements.words.management') <span class="caret"></span>
                        </a>

                        <div id="side-nav-reservations" class="panel-collapse collapse">
                            <ul class="nav nav-child">
                                @can ('authorize', config('permissions.groups.reservations.select'))
                                    @if (\Route::has('reservations.index'))<!-- TODO -->
                                        <li class="{{ request()->route()->named('reservations') ? 'active' : '' }}"><a href="{{ route('reservations.index') }}">@lang ('elements.words.reservations')@lang ('elements.words.list')</a></li>
                                    @endif
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
                                    <li class="{{ \Route::has('users.index') ? '' : 'disabled' }}"><!-- TODO -->
                                        <a href="#side-nav2-child1" class="{{ \Route::has('users.index') ? '' : 'disabled' }}" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            @lang ('elements.words.users')@lang ('elements.words.management') <span class="caret"></span>
                                        </a>

                                        <div id="side-nav2-child1" class="panel-collapse collapse">
                                            <ul class="nav nav-child">
                                            @can ('authorize', config('permissions.groups.users.select'))
                                                @if (\Route::has('users.index'))<!-- TODO -->
                                                    <li class="{{ request()->route()->named('users') ? 'active' : '' }}"><a href="{{ route('users.index') }}">@lang ('elements.words.users')@lang ('elements.words.list')</a></li>
                                                @endif
                                            @endcan
                                            </ul>
                                        </div>
                                    </li>
                                @endcan

                                <!-- Tags -->
                                <li>
                                    <a href="#side-nav2-child2" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        @lang ('elements.words.tags')@lang ('elements.words.management') <span class="caret"></span>
                                    </a>

                                    <div id="side-nav2-child2" class="panel-collapse collapse">
                                        <ul class="nav nav-child">
                                            @can ('authorize', config('permissions.groups.tags.select'))
                                                <li class="{{ request()->route()->named('tags') ? 'active' : '' }}"><a href="{{ route('tags.index') }}">@lang ('elements.words.tags')@lang ('elements.words.list')</a></li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>

                                <!-- Seats -->
                                <li>
                                    <a href="#side-nav2-child3" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        @lang ('elements.words.seats')@lang ('elements.words.management') <span class="caret"></span>
                                    </a>

                                    <div id="side-nav2-child3" class="panel-collapse collapse">
                                        <ul class="nav nav-child">
                                            <li class="{{ request()->route()->named('seats') ? 'active' : '' }}"><a href="{{ route('seats.index') }}">@lang ('elements.words.seats')@lang ('elements.words.list')</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- Menus -->
                                {{--
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
                                --}}

                                <!-- Switch selected stores -->
                                @can ('authorize', ['stores.select', 'own-company-stores.select'])
                                    <li>
                                        <a href="#side-nav2-child4" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            @lang ('elements.words.stores')@lang ('elements.words.toggle') <span class="caret"></span>
                                        </a>
                                        <div id="side-nav2-child4" class="panel-collapse collapse">
                                            <ul class="nav nav-child">
                                                @foreach ($stores as $store)
                                                    <li><a href="{{ route('home', ['store_id' => $store->id()]) }}">{{ $store->name() }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
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
                                <!-- General settings -->
                                <li class="{{ request()->route()->named('settings.index') ? 'active' : '' }}"><a href="{{ route('settings.index') }}">@lang ('elements.words.user')@lang ('elements.words.information')</a></li>

                                <li class="disabled"><a href="#">@lang ('elements.words.notification') @if ($unreadNotifications->count()) <span class="badge bg-danger">{{ $unreadNotifications->count() }}</span> @endif </a></li>

                                @env ('local')
                                    <!-- Various settings -->
                                    <li>
                                        <a href="#side-nav3-child2" data-toggle="collapse" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            @lang ('elements.words.settings') <span class="caret"></span>
                                        </a>

                                        <div id="side-nav3-child2" class="panel-collapse collapse">
                                            <ul class="nav nav-child">
                                                @can ('authorize', 'self-settings.printings.update')
                                                    <li class="{{ request()->route()->named('settings.printings.index') ? 'active' : '' }}"><a href="{{ route('settings.printings.index') }}">@lang ('elements.words.print')@lang ('elements.words.settings')</a></li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </li>
                                @endenv

                                <li role="separator" class="divider"></li>

                                <li>
                                    <a href="{{ route('logout') }}" onclick="common.submitFormWithConfirm('{{ route('logout') }}', '@lang ('Do you want to log out?')'); return false;">
                                        @lang ('elements.words.logout')
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

                    @if (\Route::has('register'))<!-- TODO -->
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
