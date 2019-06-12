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
      @if(in_array('administrator', $current_user->roles) || in_array('employee', $current_user->roles))
        <div class="uk-navbar-left uk-flex-top">
          <div class="uk-navbar-item user">
            Hello:&nbsp;<a href="{{ home_url('/settings') }}">{{ $user }}</a>
          </div>
        </div>
      @endif

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
          <ul class="uk-navbar-nav uk-visible{{ $breakpoint }} {{ wp_get_current_user()->roles[0] }}">
            @php
              wp_nav_menu([
                'items_wrap'     => '%3$s',
                'theme_location' => 'primary_navigation',
                'walker'         => new UIkitNavigation()
              ]);
            @endphp
          </ul>
          {{-- <a class="uk-navbar-toggle uk-hidden{{ $breakpoint }}" uk-toggle uk-navbar-toggle-icon href="#offcanvas-nav"></a>--}}
        </div>
      @endif
    </nav>
  </div>
</header>

{{-- STICKY MOBILE NAV --}}
<div id="sticky-mobile-nav" class="uk-hidden@m">
  <div class="categories">
    <div class="button">
      <div class="icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <h5>Categories</h5>
    </div>
    @include('components.category-tiles', ['mobile' => true])
  </div>
  <nav id="mobile-menu">
    <ul class="uk-nav-primary uk-nav-parent-icon {{ wp_get_current_user()->roles[0] }}" uk-nav="multiple: true">
      @php
        wp_nav_menu([
          'items_wrap'     => '%3$s',
          'theme_location' => 'primary_navigation',
          'walker'         => new UIkitMobileNavigation()
        ]);
      @endphp
    </ul>
  </nav>
</div>
