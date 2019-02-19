@extends('layout')

@section('content')
	  {{ Form::open(array('url' => '/rooms', 'method' => 'post', 'id' => 'groupconsumption-form')) }}
	  {{ Form::hidden('user_id', Auth::id()) }}
	  {{ Form::label('name', trans('messages.product_name'))}}
      {{ Form::text('name', null, array('id' => 'product-name', 'class' => 'group-form')) }}
      {{ Form::label('description', trans('messages.product_name'))}}
      {{ Form::text('description', null, array('id' => 'room-description', 'class' => 'group-form')) }}
@endsection