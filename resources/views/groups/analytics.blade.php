@extends('layout')

@section('content')
	<div class="row">
	    <div class="control-left">
	      @include('control_bar')
	    </div>
	    <div class="col-md-9">
	    	<h2 class="margin-top">@lang('messages.month_analytics')</h2>
	    	<table class="table table-hover" id="table1">
	    		@include('analytic_table')
			</table>
			<h2>@lang('messages.analytics_by_person')</h2>
			<table class="table table-hover">
	    		@include('user_analytics_table')
			</table>
	    </div>
	</div>
@endsection