<section
  class="offer-tiles"
  id="{{ $slug }}" style="{{ (!$filter || $filter == $slug) ? 'display:block' : 'display:none' }}"
>
  <div class="uk-container">
    <div class="uk-grid uk-grid-small" uk-grid>
      <div class="uk-width-1-1">
        <header class="uk-visible@m">{{ $heading }}</header>
        <header class="uk-hidden@m uk-flex uk-flex-between">
          <span>{{ $heading }}</span>
          <a class="uk-hidden" uk-filter-control>View All Offers</a>
        </header>
      </div>

      @php
        $args = [
          'post_type' => 'offers',
          'posts_per_page' => -1
        ];

        if ($featured) {
          $args['post__in'] = $featured;
        }

        if ($favorites) {
          $args['tax_query'] = [
            [
              'taxonomy' => 'favorites',
              'field'    => 'slug',
              'terms'    => [get_current_user_id()],
            ]
          ];
        }

        if ($term_id) {
          $args['tax_query'] = [
            [
              'taxonomy' => 'offer_categories',
              'field'    => 'term_id',
              'terms'    => [$term_id],
            ]
          ];
        }
      @endphp

      @query($args)
        <div class="uk-width-1-3@l uk-width-1-2@m uk-width-1-1">
          <a href="{{ the_permalink() }}" id="{{ get_post_field('post_name', get_the_ID()) }}" class="uk-card uk-card-default offer-tile">

            {{-- Image --}}
            @if(get_field('header_image') || get_field('logo'))
              <div class="uk-card-media-top">
                @if(get_field('logo'))
                  <img class="logo" src="{{ the_field('logo') }}">
                @elseif(get_field('header_image'))
                  <img class="header" src="{{ the_field('header_image') }}">
                @endif
              </div>
            @endif

            <div class="card-content">
              {{-- Heading & Details --}}
              <div class="uk-card-body uk-flex-1">
                @if(get_field('large_text'))
                  <h3>{{ the_field('large_text') }}</h3>
                @endif

                @if(get_field('small_text'))
                  <h4>{{ the_field('small_text') }}</h4>
                @endif

                @php
                  $post = get_post();
                  $categories = wp_get_post_terms($post->ID, 'offer_categories');
                  $category = $categories[0]
                @endphp
                <div class="divider" style="border-color: {{ the_field('highlight_color', $category) }}"></div>

                @if(get_field('details'))
                  <p class="uk-visible@m">{{ get_details_excerpt(120) }}</p>
                @endif
              </div>

              {{-- CTA --}}
              <div class="uk-card-footer">
                <span>See offer details</span>
              </div>
            </div>

          </a>
        </div>
      @endquery
    </div>
  </div>
</section>
