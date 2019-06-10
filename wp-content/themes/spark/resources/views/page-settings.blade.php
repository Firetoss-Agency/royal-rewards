{{--
  Template Name: Settings
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
        </div>
      </div>
    </div>
  </section>

  <section class="edit uk-margin-medium-bottom">
    <div class="uk-container">
      <div class="uk-grid uk-flex-center" uk-grid>
        <div class="uk-width-1-2@l uk-width-4-5@m uk-width-1-1">
          @shortcode('[wppb-edit-profile]')
        </div>
      </div>
    </div>
  </section>

@endsection
