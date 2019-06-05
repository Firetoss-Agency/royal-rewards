@extends('layouts.app')

@section('content')

  @include('components.category-tiles')

  {{-- Favorites --}}
{{--  @include('components.offer-tiles', [--}}
{{--    'heading' => 'Favorite Offers'--}}
{{--  ])--}}

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
