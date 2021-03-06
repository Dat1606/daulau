@extends('layout')

@section('content')
  <div class="row">
    <div class="control-left">
      @include('control_bar')
    </div>
    <div class="col-md-9"> 
      @if (session('status'))
        <div class="alert alert-success margin-top">
          {{ session('status') }}
        </div>
      @endif
      <div class="col-md-12">
      <div class="alert alert-success margin-top" style="display:none"></div>
      @if(!$users->isEmpty())
        <button data-toggle="modal" data-target="#add-member" class="btn btn-success glyphicon glyphicon-plus add-member-btn">@lang('messages.add_member')
        </button>
      @endif
      <button class="btn btn-success add-member-btn" data-toggle="modal" data-target="#fund">@lang('messages.raise_fund')</button>

      <button class="btn btn-success analytics-btn" ><a class="text-white" href="{{ route('analytics',$group->id)}}">@lang('messages.see_group_analytic')</a></button>

      <div class="selector">
        <span><b>Select Date Range: </b></span><input class="month-select" id="daterange" name="dates" value="{{ date('Y-m') }}">
      </div>
      <button data-toggle="modal" data-target="#add-product" class="btn btn-success glyphicon glyphicon-plus add-btn">@lang('messages.add')
      </button>
      <table class="table table-hover" id="table">
        @include('table',['all_consumptions' => $all_consumptions,'group'=>$group, 'users' => $users, 'groupConsumptions' => $groupConsumptions])
      </table>

      <h2 class="margin-top">Requests</h2>
      <table class="table table-hover margin-bottom">
        @include('GroupRequestTable', ['userGroupRequests' => $userGroupRequests])
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
         <div class="alert alert-success margin-top" style="display:none"></div>
        {{ Form::open(array('url' => '/group_consumptions', 'method' => 'post', 'id' => 'groupconsumption-form')) }}
          {{ Form::hidden('group_id', $group->id, array('id' => 'group-id', 'class' => 'group-form')) }}
          {{ Form::label('name', trans('messages.product_name'))}}
          {{ Form::text('name', null, array('id' => 'product-name', 'class' => 'group-form')) }}
          {{ Form::label('quantity', trans('messages.quantity'))}}
          {{ Form::number('quantity', 1, array('id' => 'product-quantity', 'class' => 'group-form bfh-number')) }}
          {{ Form::label('total_fee', @trans('messages.total_fee'))}}
          {{ Form::number('total_fee', null, array('id' => 'product-fee', 'class' => 'group-form')) }}
          {{ Form::label('type', @trans('messages.type')) }}
          {{ Form::select('type', array(1 => trans('messages.food'), 2 => trans('messages.general_product'),
            3 => trans('messages.water_bill'), 4 => trans('messages.electricity_bill') , 
            5 => trans('messages.hire_fee'), 6 => trans('messages.others')), null, array('id' => 'product-type', 'class' => 'group-form')) }}
          {{ Form::label('user_id', @trans('messages.buyer')) }}
          {{ Form::select('user_id', $selectUsers->pluck('name', 'id'), array('id' => 'product-person', 'class' => 'group-form'))}}
          {{ Form::hidden('creator_id', Auth::id(), array('class' => 'group-form', 'id' => 'creator_id')) }}
          {{Form::submit(trans('messages.create'), ['class' => 'btn btn-success add-btn', 'id' => 'ajaxSubmit'])}}
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

<div class="modal" id="fund" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">@lang('messages.fund')</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => '/group_requests', 'method' => 'post')) }}
          {{ Form::hidden('user_group_id', $currentUserGroup->id) }}
          {{ Form::label('value', trans('messages.withdraw_message'))}}
          {{ Form::number('value', null) }}
          {{ Form::label('type', trans('messages.type'))}}
          {{ Form::select('type', array(0 => trans('messages.withdraw_money'),1 => trans('messages.raise_fund'))) }}
          {{Form::submit(trans('messages.create'), ['class' => 'btn btn-success add-btn'])}}
        {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </div>
  </div>
</div>

<script> 
  var type = {
    1: 'Food',
    2: 'General Product',
    3: 'Water Bill',
    4: 'Electricity Bill',
    5: 'Hire Fee',
    6: 'Others',
  }
  var today = new Date();
  var startDay = today.getDate()-7;
  today = moment().format('L');
  startDay = moment().subtract(7, 'days').calendar() ;
  $('input[name="dates"]').daterangepicker();
  $('#daterange').daterangepicker({ startDate: startDay, endDate: today });
  $('#daterange').on('apply.daterangepicker', function(ev, picker) {
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
      var tr2 = '';
      var total = 0;
      $('#table-data').children().remove();
      for (var i = 0; i < result.length; i++) {
        total += result[i].total_fee
      };

      $('#table').fadeOut();
      $.each(result, function(index, value) {
        var newData = $('#group-consumption-template').html();
        newData = newData.replace(/%%group_consumption_id%%/g , value.id);
        newData = newData.replace('%%group_consumption_name%%', value.name);
        newData = newData.replace('%%group_consumption_type%%', type[value.type]);
        newData = newData.replace('%%group_consumption_quantity%%', value.quantity);
        newData = newData.replace('%%group_consumption_created_at%%', value.created_at);
        newData = newData.replace('%%user_id%%', value.user.name);
        newData = newData.replace('%%creator_id%%', value.creator.name);
        newData = newData.replace('%%group_consumption_total_fee%%', value.total_fee);
        $('#table-data').append(newData);
      });

      tr2 += '<tr><td>'+ 'All Fees'  + '</td><td>' +'</td><td>' 
            + '</td><td>' + '</td><td>' +  '</td><td></td><td>' + '</td><td>' +(new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(total)) + '</td></tr>';
      
      $('#table-data').append(tr2);
      $('#table').fadeIn();
    }
  });
  });

$( document ).ready(function() {
  $(".delete-btn").on("submit", function(){
    return confirm("Are you sure?");
  });
});
</script>
@endsection
