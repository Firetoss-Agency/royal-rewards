@extends('layouts.app')

@section('content')

  {{-- Categories --}}
  @include('components.category-tiles')

  {{-- Favorites --}}
  @php
    $user_id = get_current_user_id();
    $term = term_exists(strval(get_current_user_id()), 'favorites');
    $favorites = get_posts([
      'post_type' => 'offers',
      'posts_per_page' => -1,
      'tax_query' => [
        [
          'taxonomy' => 'favorites',
          'field'    => 'term_id',
          'terms'    => [$term['term_id']]
        ]
      ]
    ]);
  @endphp
  @if($favorites)
    @include('components.offer-tiles', [
      'heading' => 'Favorite Offers',
      'favorites' => true
    ])
  @endif

  {{-- All Offers by Category --}}
  @php
    $categories = get_terms([
      'taxonomy' => 'offer_categories',
      'hide_empty' => true
    ])
  @endphp
  @foreach($categories as $category)
    @include('components.offer-tiles', [
      'heading' => $category->name . ' Offers',
      'term_id' => $category->term_id
    ])
  @endforeach

@endsection
