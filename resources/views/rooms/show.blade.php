@extends('layout')

@section('content')
  <div class="col-md-10 col-md-offset-1">
    <div class="row">
      <div class="col-md-5">
        @if ($photo_name)
          <img class="show-room-image" src="/{{ $photo_name }}">
        @else
          <img class="show-room-image" src="https://image.freepik.com/free-icon/dwelling-house_318-1861.jpg">
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
          </div>
          <div class="col-md-6">
            <p>@lang('messages.type') {{ $room->type }}</p>
            <p>@lang('messages.price') <b>{{ $room->rent_fee }} @lang('messages.yen_per_month')</b></p>
            <p>@lang('messages.inside_toilet') <b>{{ $room->inside_toilet }}</b></p>
            <p>@lang('messages.host') {{ $host_name }}</p>
          </div>
            <p>@lang('messages.description') {{ $room->description }}</p>
          </div>
      </div>
    </div>
  </div>
@endsection
