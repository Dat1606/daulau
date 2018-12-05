<?php

namespace App\Http\Controllers;

use App\Group;
use App\UserRoom;
use App\Room;
use App\User;
use Auth;
use App\UserGroup;
use App\GroupConsumption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{


    protected $validationRules=[
                'name' => 'required|unique:groups|max:255'
    ];

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } else {
            $group = new Group;
            $group->name = $request->name;
            $group->room_id = $request->room_id;
            $group->save();
            $user = $request->user();
            $user->groups()->attach($group->id);
            return response()->json($group);
        }
    }


    public function show(Group $group)
    {
        $currentUser = Auth::user();
        $checkUser = UserGroup::where('group_id', $group->id)->where('user_id', $currentUser->id);
        if ($checkUser) {
            $currentMonth = date('m');
            $roomId = UserRoom::where('id',$group->room_id)->first()->value('room_id');
            $roomUserIds = UserRoom::where('room_id', $roomId)->pluck('user_id');
            $groupUsers = UserGroup::where('group_id', $group->id)->whereIn('user_id', $roomUserIds)->pluck('user_id');
            $users = User::whereIn('id',$roomUserIds)->whereNotIn('id', $groupUsers)->get();
            if (!isset($_GET['startDate'])) 
            {
                $groupConsumptions = GroupConsumption::whereRaw( 'MONTH(created_at) = ? ',[$currentMonth])->where('group_id', $group->id )->orderBy('created_at', 'desc')->paginate(10);
            }else{
                $groupConsumptions = GroupConsumption::whereDate('created_at','>=' ,$_GET['startDate'])->whereDate('created_at','<=' ,$_GET['endDate'])->where('group_id', $group->id )->orderBy('created_at', 'asc')->get();
                return response()->json($groupConsumptions);
            }
            $all_consumptions =  GroupConsumption::where('group_id', $group->id)->whereRaw( 'MONTH(created_at) = ? ',[$currentMonth])->selectRaw('sum(total_fee)')->get();
            return view('groups/show', ['all_consumptions' => $all_consumptions, 'group'=>$group, 'users' => $users, 'groupConsumptions' => $groupConsumptions, 'currentMonth' => $currentMonth]);
        } else {
            return view('403');
        }
    }


    public function analytics($id) 
    {

    }
    
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
