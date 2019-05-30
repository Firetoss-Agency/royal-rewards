@extends('layouts.app')

@section('content')

  @loop
    <h2>
      <a href="{{ the_permalink() }}">{{ the_title() }}</a>
    </h2>
  @endloop

  <div class="uk-container">
    <div class="uk-grid" uk-grid>
      <div class="uk-width-1-1 uk-flex uk-flex-center uk-padding">
        {!! UIkitPagination() !!}
      </div>
    </div>
  </div>
  
@endsection
