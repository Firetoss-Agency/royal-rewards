{{--
  Template Name: Login
--}}

@extends('layouts.app')

@section('content')

  <section class="login-form">
    <div class="uk-container uk-height-1-1">
      <div class="uk-grid uk-flex-middle uk-flex-center uk-height-1-1" uk-grid>
        <div class="uk-width-1-2@l uk-width-2-3@m uk-width-1-1">
          <div class="box">
            <a href="{{ home_url() }}">
              <img src="{{ the_img('logo-blue.svg') }}">
            </a>
            @shortcode('[wppb-login]')
            @shortcode('[wppb-recover-password]')
            <div class="uk-text-center">
              <button class="forgot-password-toggle">Forgot Password</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
