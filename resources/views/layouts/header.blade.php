@auth
<header class="header">
@else
<header class="header login-header">
@endauth
  <a class="navbar-brand">顧客管理システム</a>
@auth
  <nav>
    <ul class="nav navbar-nav navbar-right header-gnav">
      <li>
        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="far fa-user-circle"></i> 
        居酒屋○○
        <span class=" fa fa-angle-down"></span>
        </a>
        <ul class="dropdown-menu">          
          <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('@lang ('Do you want to log out?')')) document.getElementById('logout-form').submit(); return false;">
            <i class="fa fa-sign-out pull-right"></i>@lang ('elements.words.logout')
          </a>
          {{ Form::open(['id' => 'logout-form', 'url' => route('logout'), 'method' => 'post', 'style' => 'display: none;']) }}{{ Form::close() }}
          </li>
          <li>
            <a href="{{ route('settings.profile') }}">@lang ('elements.words.user')@lang ('elements.words.information')
              <i class="fas fa-user-cog pull-right"></i>
            </a>
          </li>
        </ul> 
      </li>
    </ul>    
  </nav>
@endauth
</header>