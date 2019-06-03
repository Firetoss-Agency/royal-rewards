@extends('layouts.app')

@section('content')
	@loop

  <section class="offer">
    <div class="uk-container">
      <div class="uk-grid uk-flex-center" uk-grid>
        <div class="uk-width-3-5@l uk-width-4-5@m uk-width-1-1">
          <nav>
            <a href="/offers">Back to Offers</a>
          </nav>
          <div class="uk-text-center">
            @if(get_field('header_image'))
              <img src="{{ the_field('header_image') }}" class="uk-margin-medium-bottom">
            @endif
            @if(get_field('logo'))
              <img src="{{ the_field('logo') }}" class="uk-margin-bottom">
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
                <a class="uk-button uk-button-primary" href="{{ $link['url'] }}" {{ $link['target'] ? 'target="'.$link['target'].'"' : '' }}>{{ $link['title'] }}</a>
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
                <a class="uk-button uk-button-primary" href="{{ $link['url'] }}" {{ $link['target'] ? 'target="'.$link['target'].'"' : '' }}>{{ $link['title'] }}</a>
              </div>
            @endif
            <div class="favorite uk-margin-medium-bottom">
              <a class="uk-button uk-button-default"><img src="{{ the_img('red-star.svg') }}"> Add offer to favorites</a>
            </div>
            <div class="back">
              <a href="/offers">Back to Offers</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 	@endloop
@endsection
