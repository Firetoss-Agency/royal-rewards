<footer class="site-footer" role="contentinfo">
  <div class="uk-container uk-container-expand">
    <div class="uk-grid" uk-grid>
      <div class="uk-width-1-2@m uk-width-1-1 uk-visible@m">
        <div class="logo">
          <img src="{{ the_img('logo-blue.svg') }}">
        </div>
      </div>
      <div class="uk-width-1-2@m uk-width-1-1">
        <div class="content">
          {{ the_field('footer_content', 'option') }}
          @set($login_page = 'http://royal-rewards.com')
          <a class="logout uk-button uk-button-primary" href="{{ wp_logout_url($login_page) }}">Logout</a>
        </div>
      </div>
    </div>
  </div>
</footer>
