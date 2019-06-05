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

	{{-- Favorites --}}
	@include('components.offer-tiles', [
		'heading' => 'Favorite Offers'
	])

	@include('components.category-tiles')

@endsection
