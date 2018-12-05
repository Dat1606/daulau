@extends('layout')

@section('content')
  <div class="row">
    <div class="control-left">
      @include('control_bar')
    </div>
    <div class="col-md-9">
      @if(!$rooms->isEmpty())
          <div class="col-md-11 room-items">
    @foreach ($rooms as $room)
      <div class="room-item col-md-8">
        <div class="room-image">
          @if (DB::table('photos')->where('room_id', $room->id)->value('name') != null)
            <img class="banner-image" src="{{ DB::table('photos')->where('room_id', $room->id)->limit(1)->value('name') }}">
          @else
            <img class="banner-image" src="https://image.freepik.com/free-icon/dwelling-house_318-1861.jpg">
          @endif
        </div>
        <div class="room-content">
          <a href=" {{ route('rooms.show', $room->id) }}" ><h4>{{ $room->name }}</h4></a>
          <p><b>@lang('messages.room_address') {{ $room->exact_place }}</b></p>
          <p>@lang('messages.price') <b>{{ $room->rent_fee }} @lang('messages.yen_per_month')</b></p>
          <p>@lang('messages.inside_toilet') <b>{{ $room->inside_toilet }}</b></p>
        </div>
      </div>
    @endforeach
    {{ $rooms->links() }}
  </div>
      </div>
  </div>
  @else
      <h2>@lang('messages.page_404') </h2>
      <a href="{{ route('rooms.index') }}"><button class="btn btn-success">@lang('messages.order_room')</button></a>
  @endif
@endsection
