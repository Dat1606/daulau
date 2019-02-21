@extends('layout')

@section('content')
	<div class="row">
		<div class="name-image">
			<img class="show-room-image" src="https://i.imacdn.com/ta/2016/11/05/0e9a2b9cc51fbab8_80502802cabefed4_10984814783641372143215.jpg">
			<h2 class="text-center">{{ $user->name }} <a href="#"><i class="fa fa-pencil"></i></a></h2>
			<div class="general-information">
				<h2>General Information</h2>
				<h5>@lang('messages.occupation'): {{ $user->occupation }}</h5>
				<h5>@lang('messages.user_address'): {{ $user->exact_address }}</h5>
			</div>
		</div>
		<div class="col-md-8">
			<div class="room-information">
				<h2 class="margin-top">User Analytics</h2>
				<table class="table table-hover">
					@include('analytic_table')
				</table>
				<h2 class="margin-top">Group Information</h2>
				@foreach($userGroups as $userGroup)
					<a href="{{ route('groups.show', $userGroup->group->id)}}"><h3>{{ $userGroup->group->name }}</h3></a>
					<table class="table table-hover" id="table">
						@include('user_table')
					</table>
				@endforeach
			</div>
		</div>
	</div>
@endsection