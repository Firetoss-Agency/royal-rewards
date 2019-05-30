{{--
  Template Name: Dashboard
--}}

@extends('layouts.app')

@section('content')

	<h1>{{ the_title() }}</h1>
	{{ wp_loginout('/') }}

@endsection
