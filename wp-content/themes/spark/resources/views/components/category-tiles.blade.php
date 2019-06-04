<section class="category-tiles">
  <div class="uk-container">
    <div class="uk-grid" uk-grid>
      <div class="uk-width-1-1">
        <header>Offers by category</header>
      </div>
    </div>
    <div class="uk-grid uk-grid-collapse uk-grid-match" uk-grid>
      @php
        $categories = get_terms([
          'taxonomy' => 'offer_categories',
          'hide_empty' => false
        ])
      @endphp
      @foreach($categories as $category)
        <div class="uk-width-1-6@l uk-width-1-3@s uk-width-1-2">
          <a class="tile" href="/offers?cat={{ $category->slug }}" style="border-color: {{ the_field('highlight_color', $category) }}">
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