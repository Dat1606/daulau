@extends('layout')

@section('content')
<div class="row">
	<div class="control-left">
		@include('control_bar')
	</div>
	<div class="col-md-8">
		<h2 class="margin-top">Edit this consumption</h2>
		{{ Form::model($groupConsumption, array('route' => array('group_consumptions.update', $groupConsumption->id), 'method' => 'patch', 'id' => 'groupconsumption-form')) }}
          <div class="alert alert-danger" style="display:none"></div>
          {{ Form::hidden('group_id', $groupConsumption->group_id, array('id' => 'group-id', 'class' => 'group-form')) }}
          {{ Form::label('name', trans('messages.product_name'))}}
          {{ Form::text('name', null, array('id' => 'product-name', 'class' => 'form-control')) }}
          {{ Form::label('quantity', trans('messages.quantity'))}}
          {{ Form::number('quantity', 1, array('id' => 'product-quantity', 'class' => 'form-control')) }}
          {{ Form::label('total_fee', @trans('messages.total_fee'))}}
          {{ Form::number('total_fee', null, array('id' => 'product-fee', 'class' => 'form-control')) }}
          {{ Form::label('type', @trans('messages.type')) }}
          {{ Form::select('type', array(1 => trans('messages.food'), 2 => trans('messages.general_product'),
            3 => trans('messages.water_bill'), 4 => trans('messages.electricity_bill') , 
            5 => trans('messages.hire_fee'), 6 => trans('messages.others')), null, array('id' => 'product-type', 'class' => 'form-control')) }}
          {{ Form::label('user_id', @trans('messages.buyer'))}}
          {{ Form::select('user_id', $groupUsers->pluck('name', 'id'), null, ['class' => 'form-control']) }}
          {{ Form::hidden('creator_id', Auth::id(),['class' => 'form-control'] )}}
          {{Form::submit(trans('messages.create'), ['class' => 'btn btn-success add-btn'])}}
        {{ Form::close() }}

	</div>
</div>

@endsection
