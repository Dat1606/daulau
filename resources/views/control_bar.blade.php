<ul class="control-bar-ul">
  <li><a href="{{ route('home')}}">Home</a></li>
  <li><a href=".dropdown-menu1" class="dropdown-toggle" data-toggle="collapse">Room Management</a>
  	<ul class="dropdown-menu1">
  		@foreach ($userRooms as $userRoom)
      		<li><a class="dropdown-item" href="{{ route('myroom',$userRoom->id) }}">{{ $userRoom->name }}</a></li>
      	@endforeach
      	<li><a class="dropdown-item" href="/my_rooms">All Rooms</a></li>
  	</ul>
  </li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>
 