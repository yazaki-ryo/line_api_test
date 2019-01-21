@auth
<header class="navbar-default navbar-fixed-top main-header">
@else
<header class="navbar-default navbar-fixed-top main-header login-header">
@endauth
  <a class="navbar-brand">neeeds 顧客管理</a>
@auth
  <nav>    
    <ul class="nav navbar-nav navbar-right header-gnav">      
      <li>
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="far fa-user-circle"></i> 
        {{ $currentStore->name() ?? null }}        
        <span class=" fa fa-angle-down"></span>
        </a>
        <ul class="navbar-sub-nav dropdown-menu">
          <li>
            <p class="center">@lang ('Welcome, :name.', ['name' => $user->name()])</p>
          </li>
          <li>
              <a href="{{ route('logout') }}" onclick="common.submitFormWithConfirm('{{ route('logout') }}', '@lang ('Do you want to log out?')'); return false;">
                  <i class="fa fa-sign-out pull-right"></i>@lang ('elements.words.logout')
              </a>
          </li>
          <li>
              <a href="{{ route('settings.index') }}">@lang ('elements.words.user')@lang ('elements.words.information')
                  <i class="fas fa-user-cog pull-right"></i>
              </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
@endauth
</header>
