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
use Carbon\Carbon;
use DB;
use App\UserGroupRequest;
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
        $currentUserGroup = UserGroup::where('group_id', $group->id)
                ->where('user_id', $currentUser->id)->first();

        $checkUser = UserGroup::where('group_id', $group->id)
                ->where('user_id', $currentUser->id)->get();

        if ($checkUser && $currentUserGroup) {

            $currentMonth = date('m');
            $roomId = UserRoom::where('id',$group->room_id)->value('room_id');
            $roomUserIds = UserRoom::where('room_id', $roomId)->pluck('user_id');
            $groupUsers = UserGroup::where('group_id', $group->id)
                    ->whereIn('user_id', $roomUserIds)->get();
            $selectUsers = User::whereIn('id', $groupUsers->pluck('user_id'))
                    ->get();

            $users = User::whereIn('id',$roomUserIds)->whereNotIn('id', 
                    $groupUsers->pluck('user_id'))->get();

            $userGroupRequests = UserGroupRequest::whereIn('user_group_id', 
                    $groupUsers->pluck('id'))->orderBy('created_at', 'desc')
                        ->get();

            if (!isset($_GET['startDate'])) 
            {
                $groupConsumptions = GroupConsumption::where('created_at', '>=', Carbon::now()->startOfMonth())->where('group_id', $group->id)->orderBy('created_at', 'desc')->with('user')->paginate(10);
            }else{
                $groupConsumptions = GroupConsumption::whereDate('created_at','>=' ,$_GET['startDate'])->whereDate('created_at','<=' ,$_GET['endDate'])->where('group_id', $group->id )->orderBy('created_at', 'asc')->with('user:id,name')->with('creator:id,name')->get();
                return response()->json($groupConsumptions);
            }
            $all_consumptions =  GroupConsumption::where('group_id', $group->id)->where('created_at', '>=', Carbon::now()->startOfMonth())->get()->flatten()->sum('total_fee');
            return view('groups/show', ['all_consumptions' => $all_consumptions, 'currentUserGroup' => $currentUserGroup ,'group'=>$group, 'users' => $users, 'groupConsumptions' => $groupConsumptions, 'currentMonth' => $currentMonth, 'userGroupRequests' => $userGroupRequests, 'selectUsers' => $selectUsers]);
        } else {
            return view('403');
        }
    }


    public function analytics($id) 
    {   
        $group = Group::find($id);
        $userIds = UserGroup::where('group_id', $id)->pluck('user_id');
        $users = User::whereIn('id', $userIds)->with(['userGroups' => function($query) use ($id) {
                $query->where('group_id', '=', $id);
                }, 'groupConsumptions' => function($query) use ($id) {
                $query->where('group_id', '=', $id);
                }])->get();
        $monData = GroupConsumption::where('group_id', $id)->get()->groupBy(function($d) 
        {
            return Carbon::parse($d->created_at)->format('m');
        });
        $groupFund = UserGroup::where('group_id', '=', $id)->select('supported_budget', 'withdrew_money')->get();
        return view('groups/analytics', ['monData'=> $monData,'users' => $users, 'group' => $group , 'groupFund' => $groupFund]);
    }
    
    public function edit(Group $group)
    {
        //er
    }

    public function update(Request $request, Group $group)
    {
        //
    }

    public function destroy(Group $group)
    {
        //
    }
}
