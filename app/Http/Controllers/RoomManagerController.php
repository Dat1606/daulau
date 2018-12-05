<?php

namespace App\Http\Controllers;

use App\UserRoom;
use App\User;
use App\Room;
use App\Photo;
use App\Group;
use Illuminate\Http\Request;
use Auth;

class RoomManagerController extends Controller
{

    public function create()
    {
        //
    }

    public function index() 
    {
        $user = Auth::user();
        $userRooms = UserRoom::where('user_id', $user->id)->paginate(15);
        return view('user_rooms/index', ['userRooms' => $userRooms]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $user->rooms()->attach($request->room_id);
        return redirect()->route('myroom', ['id' => $request->room_id]);
    }

    public function show(UserRoom $user_room)
    {
        //
        $room = Room::where('id', $user_room->room_id)->first();
        $users = User::where('id', $user_room->user_id)->get();
        $photo_name = Photo::where('room_id', $room->id)->value('name');
        $host_name = User::where('id', $room->user_id)->value('name');
        $groups = Group::where('user_room_id', $user_room->id)->get();
        return view('user_rooms/show', ['room' => $room, 'users' => $users, 'photo_name' => $photo_name,
            'user_room' => $user_room, 'host_name' => $host_name, 'groups' => $groups]);
    }

    public function edit(UserRoom $user_room)
    {
        //
    }

    public function update(Request $request, User_room $user_room)
    {
        //
    }

    public function destroy(User_room $user_room)
    {
        //
    }
}
