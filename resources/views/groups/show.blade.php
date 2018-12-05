@extends('layout')

@section('content')
  <div class="row">
    <div class="control-left">
      @include('control_bar')
    </div>
    <div class="col-md-9"> 
      @if(!$users->isEmpty())
        <button data-toggle="modal" data-target="#add-member" class="btn btn-success glyphicon glyphicon-plus add-member-btn">@lang('messages.add_member')
        </button>
      @endif
      <div class="col-md-11">
      <div class="alert alert-success" style="display:none"></div>
      <div class="selector">
        <span><b>Select Date Range: </b></span><input class="month-select" id="daterange" name="dates" value="{{ date('Y-m') }}">
      </div>
      <button data-toggle="modal" data-target="#add-product" class="btn btn-success glyphicon glyphicon-plus add-btn">@lang('messages.add')
      </button>
      <table class="table table-hover" id="table">
        @include('table',['all_consumptions' => $all_consumptions,'group'=>$group, 'users' => $users, 'groupConsumptions' => $groupConsumptions])
      </table>
    </div>
  </div>
<div class="modal" id="add-product" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('messages.add_bought_product')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => '/group_consumptions', 'method' => 'post', 'id' => 'groupconsumption-form')) }}
          <div class="alert alert-danger" style="display:none"></div>
          {{ Form::hidden('group_id', $group->id, array('id' => 'group-id', 'class' => 'group-form')) }}
          {{ Form::label('name', trans('messages.product_name'))}}
          {{ Form::text('name', null, array('id' => 'product-name', 'class' => 'group-form')) }}
          {{ Form::label('quantity', trans('messages.quantity'))}}
          {{ Form::number('quantity', 1, array('id' => 'product-quantity', 'class' => 'group-form bfh-number')) }}
          {{ Form::label('total_fee', @trans('messages.total_fee'))}}
          {{ Form::number('total_fee', null, array('id' => 'product-fee', 'class' => 'group-form')) }}
          {{ Form::select('type', array(1 => trans('messages.food'), 2 => trans('messages.general_product'),
            3 => trans('messages.water_bill'), 4 => trans('messages.electricity_bill') , 
            5 => trans('messages.hire_fee'), 6 => trans('messages.others')), null, array('id' => 'product-type', 'class' => 'group-form')) }}
          {{ Form::hidden('user_id', Auth::id(), array('id' => 'product-person', 'class' => 'group-form'))}}
          {{Form::submit(trans('messages.create'), ['class' => 'btn btn-success', 'id' => 'ajaxSubmit'])}}
        {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="add-member" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('messages.add_member')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{ Form::open(array('url' => '/user_groups')) }}
        @foreach ($users as $user)
          <label><input type="checkbox" name="user[]" value="{{$user->id}}">{{$user->name}}</label>
        @endforeach
        {{ Form::hidden('group_id', $group->id)}}
        {{Form::submit(trans('messages.add_member'), ['class' => 'btn btn-success add-btn'])}}
      {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </div>
  </div>
</div>

<script> 
  var today = new Date();
  var startDay = today.getDate()-7;
  today = moment().format('L');
  startDay = moment().subtract(7, 'days').calendar() ;
  $('input[name="dates"]').daterangepicker();
  $('#daterange').daterangepicker({ startDate: startDay, endDate: today });
   $('#daterange').on('apply.daterangepicker', function(ev, picker) {
    console.log(picker.startDate.format('YYYY-MM-DD'));
    console.log(picker.endDate.format('YYYY-MM-DD'));
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '{{ URL::route('groups.show',['id' => $group->id]) }}',
    type: 'get',
    data: {
      startDate: picker.startDate.format('YYYY-MM-DD'),
      endDate: picker.endDate.format('YYYY-MM-DD'),
      _token : $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(result) {
      var tr = '';
      var tr2 = '';
      var total = 0;
      for (var i = 0; i < result.length; i++) {
        total += result[i].total_fee
      };
      $('#table').fadeOut();
      $.each(result, function(index, value) {
        console.log(value);
            tr += '<tr><td>' + value.id + '</td><td>' + value.name +'</td><td>' + value.type 
            + '</td><td>' + value.quantity + '</td><td>' + value.created_at + '</td><td>'+ value.user_id + '</td><td>' + value.total_fee + '</td></tr>';
      });
      tr2 += '<tr><td>'+ 'All Fees'  + '</td><td>' +'</td><td>' 
            + '</td><td>' + '</td><td>' +  '</td><td>' + '</td><td>' +(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total)) + '</td></tr>';
      $('#table-data').html(tr);
      $('#table').append(tr2);
      $('#table').fadeIn();
    }
  });
  });
</script>
@endsection
