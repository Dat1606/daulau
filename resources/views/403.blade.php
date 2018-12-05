@extends('layout')

@section('content')
	<div class="bold">
		<h1 class="text-center text1"> You don't have access to this page.</h1>
		<a href="{{route('home')}}"><button class="btn btn-success back-btn">Take me back</button></a>
	</div>
@endsection