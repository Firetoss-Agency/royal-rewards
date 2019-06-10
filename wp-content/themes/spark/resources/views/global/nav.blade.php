@php
  global $current_user;
  get_currentuserinfo();
  $user = ($current_user->user_firstname) ?: $current_user->display_name;

  $breakpoint = '@m';
  $logo = the_img('logo-white.svg');
  $symbol = the_img('symbol.svg');
@endphp

<header id="site-header">
  <div class="uk-container uk-container-expand">
    <nav class="uk-navbar-container uk-navbar-transparent uk-navbar" uk-navbar="offset: 0; delay-hide: 500;">

      {{-- User --}}
      <div class="uk-navbar-left uk-flex-top uk-visible@m">
        <div class="uk-navbar-item user">
          Hello:&nbsp;<a href="{{ home_url('/settings') }}">{{ $user }}</a>
        </div>
      </div>

      {{-- Logo --}}
      <div class="uk-navbar-center uk-height-1-1">
        <div class="uk-navbar-item uk-height-1-1">
          <a class="uk-logo" href="{{ home_url('/dashboard') }}">
            <img class="logo" src="{{ $logo }}" alt="Logo">
            <img class="symbol" src="{{ $symbol }}" alt="Symbol">
          </a>
        </div>
      </div>

      {{-- Menu --}}
      @if(has_nav_menu('primary_navigation'))
        <div class="uk-navbar-right uk-flex-top">
          <ul class="uk-navbar-nav uk-visible{{ $breakpoint }}">
            @php
              wp_nav_menu([
                'items_wrap'     => '%3$s',
                'theme_location' => 'primary_navigation',
                'walker'         => new UIkitNavigation()
              ]);
            @endphp
          </ul>
          <a class="uk-navbar-toggle uk-hidden{{ $breakpoint }}" uk-toggle uk-navbar-toggle-icon href="#offcanvas-nav"></a>
        </div>
      @endif
    </nav>
  </div>
</header>

@if(has_nav_menu('primary_navigation'))
  <nav id="offcanvas-nav" uk-offcanvas="flip: true; overlay: true;">
    <div class="uk-offcanvas-bar">

      <button class="uk-offcanvas-close" type="button" uk-icon="icon:close;ratio:1.5"></button>

      <ul class="uk-nav-primary uk-nav-parent-icon" uk-nav="multiple: true">
        <li class="menu-item">
          <span>
            <a href="{{ home_url('/dashboard') }}">Dashboard</a>
          </span>
        </li>
        @php
          wp_nav_menu([
            'items_wrap'     => '%3$s',
            'theme_location' => 'primary_navigation',
            'walker'         => new UIkitMobileNavigation()
          ]);
        @endphp
      </ul>

    </div>
  </nav>
@endif
