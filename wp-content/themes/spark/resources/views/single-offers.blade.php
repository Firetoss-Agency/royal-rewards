@extends('layouts.app')

@section('content')

	@loop
    <section class="offer">
    <div class="uk-container">
      <div class="uk-grid uk-flex-center" uk-grid>
        <div class="uk-width-3-5@l uk-width-4-5@m uk-width-1-1">
          <div class="uk-text-center">
            @if(get_field('header_image'))
              <img src="{{ the_field('header_image') }}" class="uk-margin-medium-bottom">
            @endif
            @if(get_field('logo'))
              <img class="logo uk-margin-bottom" src="{{ the_field('logo') }}" class="uk-margin-bottom">
            @endif
            @if(get_field('large_text'))
              <h2>{{ the_field('large_text') }}</h2>
            @endif
            @if(get_field('small_text'))
              <h3 class="uk-margin-bottom">{{ the_field('small_text') }}</h3>
            @endif
            @set($link = get_field('button'))
            @if($link)
              <div class="uk-text-center uk-margin-medium-bottom">
                <hr class="uk-width-1-2@l uk-width-2-3@m uk-width-1-1">
                <a class="uk-button uk-button-primary view-offer" id="top-btn-{{ get_post_field('post_name', get_the_ID()) }}" href="{{ $link['url'] }}" {{ $link['target'] ? 'target="'.$link['target'].'"' : '' }}>{{ $link['title'] }}</a>
              </div>
            @endif
          </div>
          @if(get_field('details'))
            <div class="details uk-margin-medium-bottom">
              <header>
                <h4>Offer Details:</h4>
                @if(get_field('expiration_date'))
                  <h5>Exp &nbsp;{{ the_field('expiration_date') }}</h5>
                @endif
              </header>
              <div class="content">
                {{ the_field('details') }}
              </div>
            </div>
          @endif
          @if(get_field('map_embed'))
            <div class="map uk-margin-large-bottom">
              <h4>{{ the_field('map_heading') }}</h4>
              {{ the_field('map_embed') }}
            </div>
          @endif
          <div class="uk-text-center uk-margin-bottom">
            @if($link)
              <div class="uk-margin-bottom">
                <a class="uk-button uk-button-primary view-offer" id="btm-btn-{{ get_post_field('post_name', get_the_ID()) }}" href="{{ $link['url'] }}" {{ $link['target'] ? 'target="'.$link['target'].'"' : '' }}>{{ $link['title'] }}</a>
              </div>
            @endif

            {{-- If an user is an employee show favorites button --}}
            @if(in_array('employee', wp_get_current_user()->roles))
              <div class="favorite uk-margin-bottom">
                @php
                  // Check if user id is already a term in favorites taxonomy
                  $users_term = get_term_by('slug', get_current_user_id(), 'favorites');
                  $users_term_id = 0;
                  if ($users_term) {

                    // Store the term ID
                    $users_term_id = $users_term->term_id;

                    // Check if the User already has this Offer as a favorite
                    $favorited = has_term($users_term_id, 'favorites');
                  }
                @endphp
                <a
                  class="uk-button uk-button-default favorite-button"
                  data-user="{{ get_current_user_id() }}"
                  data-term="{{ $users_term_id }}"
                  data-offer="{{ get_the_ID() }}"
                  data-favorited="{{ $favorited }}"
                >
                  <img src="{{ the_img('red-star.svg') }}">
                  <span class="remove uk-hidden">Remove offer from favorites</span>
                  <span class="add">Add offer to favorites</span>
                </a>
              </div>
            @endif
            <div class="back uk-margin-large-top">
              <a href="/offers">Back to Offers</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 	@endloop

  @include('components.category-tiles')

@endsection
