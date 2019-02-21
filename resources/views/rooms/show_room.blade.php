@extends('layout')

@section('content')
<div class="row">
  <div class="control-left">
      @include('control_bar')
  </div>
  <div class="col-md-9">
    <div class="row">
      @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
      @endif

      <div class="col-md-5">
        @if ($photo_name)
          <img class="show-room-image" src="/{{ $photo_name }}">
        @else
          <img class="show-room-image" src="https://junkmailimages.blob.core.windows.net/large/80c5d9d9d43b4626bf7173fc9724afde.jpg">
        @endif
        
      </div>
      <div class="col-md-6 show-room-content">
      <h4>{{ $room->name }}</h4>
        <p><b>@lang('messages.room_address') {{ $room->exact_place }}</b></p>
        <div class="row">
          <div class="col-md-6">
            <p>@lang('messages.allow_number') {{ $room->allow_number }} @lang('messages.people')</p>
            <p>@lang('messages.present_number') {{ $room->present_number }} @lang('messages.people')</p>
            <p>@lang('messages.width') {{ $room->width }} @lang('messages.square_metre')</p>
            <p>@lang('messages.floor') {{ $room->floor }} @lang('messages.floor1')</p>
            <p>@lang('messages.description') {{ $room->description }}</p>
            <h2 class="show-room-content">@lang('messages.manage')( @foreach ($users as $user)
                {{ $user->name }} @endforeach)</h2>
          </div>
          <div class="col-md-6">
            <p>@lang('messages.type') {{ $room->type }}</p>
            <p>@lang('messages.price') <b>{{ $room->rent_fee }} @lang('messages.yen_per_month')</b></p>
            <p>@lang('messages.inside_toilet') <b>{{ $room->inside_toilet }}</b></p>
            <p>@lang('messages.host') {{ $host_name }}</p>
            <button data-toggle="modal" data-target="#myModal" 
              class="btn btn-success">@lang('messages.create_a_group')</button>
          </div>
          </div>
      </div>
      <div class="">
        @foreach ($groups as $group)
          <div class="group">
            <a href="{{route('groups.show', [$group->id])}}" class="group-text">
                <img class="group-image" src="https://cdnservices.group.com/media/5575765/group-logo.png">
              <b>  {{ $group->name }}</b></a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
  <div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('messages.create_a_group')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{ Form::open(array('url' => '/groups', 'id' => 'group-form')) }}
        <div class="alert alert-danger" style="display:none"></div>
        {{ Form::hidden('user_room_id', $room->id, ['id' => 'user-room-id']) }}
        {{ Form::label('name', 'Group Name')}}
        <input type="text" name="name" id="group-name">
        {{Form::submit(trans('messages.create'), ['class' => 'btn btn-success', 'id' => 'group-btn'])}}
      {{ Form::close() }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </div>
  </div>
</div>
@endsection
