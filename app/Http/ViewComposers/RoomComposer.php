<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use App\UserRoom;
use App\Room;

class RoomComposer {

    public function compose(View $view) {
        if (Auth::check()) 
        {
            $user = Auth::user();
            $userRoomIds = UserRoom::where('user_id',$user->id)->pluck('room_id');
            $userRooms = Room::whereIn('id', $userRoomIds)->get();
            $view->with('userRooms', $userRooms);
        }
        
    }
}
