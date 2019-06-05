@extends('layouts.app')

@section('content')

  @set($category = get_queried_object())

  @include('components.offer-tiles', [
    'heading' => $category->name . ' Offers',
    'term_id' => $category->term_id
  ])

  @include('components.category-tiles')

@endsection
