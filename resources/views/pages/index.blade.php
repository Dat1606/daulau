@extends('layout')

@section('content')
  <div class="row">
    <div class="content-left col-md-3 text-center">
      <a href="#">
        <h2 class="banner">@lang('messages.i_have_a_room')</h2>
        <h5 class="slogan">@lang('messages.host_banner')</h5>
        <p class="description">@lang('messages.host_page_description')</p>
      </a>
    </div>
    <div class="content-center col-md-3 text-center">
      <a href="#">
        <h3 class="banner">@lang('messages.i_want_to_rent_a_room')</h3>
        <h5 class="slogan">@lang('messages.rent_page_banner')</h5>
        <p class="description">@lang('messages.rent_page_description')</p>
      </a>
    </div>
    <div class="content-right col-md-3 text-center">
      <a href="#">
        <h3 class="banner">@lang('messages.i_want_to_manage_my_room')</h3>
        <h5 class="slogan">@lang('messages.manager_page_banner')</h5>
        <p class="description">@lang('messages.manager_page_description')</p>
      </a>
    </div>
  </div>
@endsection
