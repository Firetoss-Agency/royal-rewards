<section id="categories" class="category-tiles{{ $mobile ? ' category-tiles--mobile' : ' uk-visible@m' }}">
  <div class="uk-container">
    @if(!$mobile)
      <div class="uk-grid" uk-grid>
        <div class="uk-width-1-1">
          <header class="uk-flex uk-flex-between">
            <span>Offers by category</span>
            <a class="uk-hidden" uk-filter-control>View All Offers</a>
          </header>
        </div>
      </div>
    @endif
    <div class="uk-grid uk-grid-collapse uk-grid-match uk-flex-center" uk-grid>
      @php
        $categories = get_terms([
          'taxonomy' => 'offer_categories',
          'hide_empty' => false
        ]);
        $total_cat = count($categories);
      @endphp
      @foreach($categories as $category)
        <div class="{{ ($total_cat <= 6) ? 'uk-width-1-'.$total_cat.'@l uk-width-1-'.(ceil($total_cat / 2)) : 'uk-width-1-4@l uk-width-1-'.ceil($total_cat / 2) }}">
          <a
            class="tile{{ ($filter && $filter == $category->slug) ? ' uk-active' : '' }}"
            @if(is_archive('offers'))
              uk-filter-control="#{{ $category->slug }}"
            @else
              href="/offers/?filter={{ $category->slug }}"
            @endif
            style="border-color: {{ the_field('highlight_color', $category) }}"
          >
            <div class="icon">
              <img src="{{ the_field('category_icon', $category) }}">
            </div>
            <div class="title" style="color: {{ the_field('highlight_color', $category) }}">{{ $category->name }}</div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>
