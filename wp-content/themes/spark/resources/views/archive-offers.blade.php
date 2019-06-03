@extends('layouts.app')

@section('content')
	@loop
    <h1><a href="{{ the_permalink() }}">{{ the_title() }}</a></h1>
	@endloop
@endsection
