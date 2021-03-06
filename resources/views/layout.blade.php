<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="{{ asset('js/add.js') }}" rel="javascript" type="text/javascript"></script>
  </head>
<body>
  <div class="body-content">
    <nav class="navbar navbar-dark bg-dark">
      <div class="container">
        <a href="{{ route('home')}}" id="logo">@lang('messages.page_name')</a>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="@lang('messages.address')" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">@lang('messages.search')</button>
        </form>
        <div class="nav-right">
        @if (Auth::guest())
          <a href="{{ route('login') }}" class="nav-item">@lang('messages.sign_in')</a>
          <span class="nav-word">or</span>
          <a href="{{ route('register') }}" class="nav-item">@lang('messages.sign_up')</a>
        @else
        <div class="nav-item dropdown">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                 {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item user-dropdown" href="{{ route('users.show', Auth::id()) }}">Profile Page</a>
                <a href="{{ route('logout') }}" class="dropdown-item user-dropdown"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                  {{ csrf_field() }}
                </form>
            </div>
        </div>
        @endif
        </div>
      </div>
    </nav>

  <div class="container-fluid page-content">
    @yield('content')
  </div>
 
  <footer class="page-footer font-small teal pt-4">
    <div class="container-fluid text-center text-md-left">

      <!-- Grid row -->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-6 mt-md-0 mt-3">

          <!-- Content -->
          <h5 class="text-uppercase font-weight-bold">Footer text 1</h5>
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita sapiente sint, nulla, nihil repudiandae commodi voluptatibus corrupti animi sequi aliquid magnam debitis, maxime quam recusandae harum esse fugiat. Itaque, culpa?</p>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none pb-3">

        <!-- Grid column -->
        <div class="col-md-6 mb-md-0 mb-3">

          <!-- Content -->
          <h5 class="text-uppercase font-weight-bold">Footer text 2</h5>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio deserunt fuga perferendis modi earum commodi aperiam temporibus quod nulla nesciunt aliquid debitis ullam omnis quos ipsam, aspernatur id excepturi hic.</p>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Text -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Copyright:
      <a href="https://www.facebook.com/profile.php?id=100023451998072&ref=bookmarks" target="_blank"> nguyen.duc.dat@framgia.com</a>
    </div>
    <!-- Copyright -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
      
        var http = require("http");
        setInterval(function() {
            http.get("http://daulau.herokuapp.com");
        }, 300000); // every 5 minutes (300000)
    </script>
  </footer>
</div>
</body>
</html>
