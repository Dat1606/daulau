@extends('layout')

@section('content')
	<div class="page-content">
		{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'patch', 'id' => 'groupconsumption-form')) }}
		{{ Form::label('name', trans('messages.name'))}}
	    {{ Form::text('name', null, array('id' => 'product-name', 'class' => 'form-control')) }}
	    {{Form::submit(trans('messages.create'), ['class' => 'btn btn-success add-btn'])}}
		{{ Form::close() }}
	</div>
@endsection