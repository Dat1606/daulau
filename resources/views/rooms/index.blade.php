@extends('layout')

@section('content')
  <div class="col-md-11 room-items">
    @foreach ($rooms as $room)
      <div class="room-item col-md-8">
        <div class="room-image">
          @if (DB::table('photos')->where('room_id', $room->id)->value('name') != null)
            <img class="banner-image" src="{{ DB::table('photos')->where('room_id', $room->id)->limit(1)->value('name') }}">
          @else
            <img class="banner-image" src="https://junkmailimages.blob.core.windows.net/large/80c5d9d9d43b4626bf7173fc9724afde.jpg">
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
@endsection
