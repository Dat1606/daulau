<?php

namespace App\Http\Controllers;

use App\Room;
use App\Photo;
use App\User;
use App\UserRoom;
use Auth;
use App\Group;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::paginate(15);
        return view('rooms/index', ['rooms' => $rooms]);
    }

    public function myrooms() 
    {
        $user = Auth::user();
        $userRoomIds = UserRoom::where('user_id',$user->id)->pluck('room_id');
        $rooms = Room::whereIn('id', $userRoomIds)->paginate(10);
        return view('rooms/myrooms', ['rooms' => $rooms]);
    }

    public function myroom($id)
    {
        $room = Room::find($id);
        $roomUserIds = UserRoom::where('room_id' , $room->id)->pluck('user_id');
        $current_user = Auth::user();
        $check_auth = UserRoom::where('room_id', $room->id)->where('user_id', $current_user->id)->get();
        if (!$check_auth->isEmpty()){
            $user_room = UserRoom::where('room_id', $room->id);
            $photo_name = Photo::where('room_id', $room->id)->value('name');
            $users = User::whereIn('id', $roomUserIds)->get();
            $host_name = User::where('id', $room->user_id)->value('name');
            $groups = Group::where('room_id', $room->id)->get();
            return view('rooms/show_room', ['room' => $room, 'users' => $users, 'photo_name' => $photo_name,
                'user_room' => $user_room, 'host_name' => $host_name, 'groups' => $groups]);
        }
        else
        {
            return view('403');
        }

    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('room/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
        $photo_name = Photo::where('room_id', $room->id)->value('name');
        $host_name = User::where('id', $room->user_id)->value('name');
        if ((Auth::check()) && (in_array(Auth::user()->id, UserRoom::where('room_id', $room->id)->pluck('user_id')->toArray()))) 
        {
            return redirect(route('myroom', UserRoom::where('room_id', $room->id)->first()->id));
        } else {
            return view('rooms/show', ['room' => $room, 'photo_name' => $photo_name, 'host_name' => $host_name]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
