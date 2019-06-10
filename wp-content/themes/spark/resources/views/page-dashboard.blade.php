{{--
  Template Name: Dashboard
--}}

@extends('layouts.app')

@section('content')

	<section class="intro">
		<div class="uk-container">
		  <div class="uk-grid uk-flex-center" uk-grid>
		    <div class="uk-width-1-2@l uk-width-2-3@m uk-width-1-1">
		      <div class="content">
						{{ the_field('intro') }}
					</div>
					<div class="cta">
						@set($link = get_field('intro_button'))
						@if($link)
						  <a class="uk-button uk-button-primary uk-margin-top" href="{{ $link['url'] }}" {{ $link['target'] ? 'target="'.$link['target'].'"' : '' }}>{{ $link['title'] }}</a>
						@endif
					</div>
		    </div>
		  </div>
		</div>
	</section>

	{{-- Featured --}}
	@if(get_field('featured_offers', 'option'))
		@include('components.offer-tiles', [
      'heading' => 'Featured Offers',
      'featured' => get_field('featured_offers', 'option')
    ])
	@endif

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

	{{-- Categories --}}
	@include('components.category-tiles')

@endsection
