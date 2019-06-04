<section class="offer-tiles">
  <div class="uk-container">
    <div class="uk-grid uk-grid-small" uk-grid>
      <div class="uk-width-1-1">
        <header>{{ $heading }}</header>
      </div>

      @php
        $args = [
          'post_type' => 'offers',
          'posts_per_page' => -1
        ];
      @endphp

      @query($args)
        <div class="uk-width-1-3@m uk-width-1-2@s uk-width-1-1">
          <a href="{{ the_permalink() }}" class="uk-card uk-card-default">

            {{-- Image --}}
            @if(get_field('header_image') || get_field('logo'))
              <div class="uk-card-media-top">
                @if(get_field('header_image'))
                  <img src="{{ the_field('header_image') }}">
                @elseif(get_field('logo'))
                  <img class="logo" src="{{ the_field('logo') }}">
                @endif
              </div>
            @endif

            {{-- Heading --}}
            <div class="uk-card-header">
              @if(get_field('large_text'))
                <h3>{{ the_field('large_text') }}</h3>
              @endif
              @if(get_field('small_text'))
                <h4>{{ the_field('small_text') }}</h4>
              @endif
            </div>

            {{-- Details --}}
            <div class="uk-card-body">
              <p>{{ get_details_excerpt(120) }}</p>
            </div>

            {{-- CTA --}}
            <div class="uk-card-footer">
              <span>See offer details</span>
            </div>

          </a>
        </div>
      @endquery
    </div>
  </div>
</section>
