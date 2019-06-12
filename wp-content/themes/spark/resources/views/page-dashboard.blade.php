{{--
  Template Name: Dashboard
--}}

@extends('layouts.app')

@section('content')

	<section class="intro">
		<div class="uk-container">
		  <div class="uk-grid uk-flex-center" uk-grid>
		    <div class="uk-width-1-2@l uk-width-2-3@m uk-width-1-1">
					<div class="uk-hidden@m uk-padding uk-padding-remove-top">
						<img src="{{ the_img('logo-blue.svg') }}">
					</div>
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

	<div class="uk-container">
	  <div class="uk-grid" uk-grid>
	    <div class="uk-width-1-1 uk-text-center uk-margin-large-bottom">
				<a href="/offers" class="uk-button uk-button-primary">See all offers</a>
	    </div>
	  </div>
	</div>

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

	<div class="uk-hidden@m uk-text-center uk-margin-bottom">
		<a href="{{ home_url('/offers') }}" class="uk-button uk-button-primary">See All Offers</a>
	</div>

	{{-- Categories --}}
	@include('components.category-tiles')

@endsection
