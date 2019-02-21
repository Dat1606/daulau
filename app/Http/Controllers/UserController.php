<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use App\UserGroup;
use App\UserRoom;
use App\GroupConsumption;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.user.show', ['only' => ['show']]);
    }

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
        //
    }

    public function show(User $user)
    {
        $userGroups = UserGroup::where('user_id', $user->id)->get();
        $rooms = UserRoom::where('user_id', $user->id)->get();
        $monData = $user->groupConsumptions->groupBy(
            function($d) 
            {
                return Carbon::parse($d->created_at)->format('m');
            });
        return view('users/show',['user' => $user, 'userGroups' => $userGroups, 'monData' => $monData]);
    }

    public function edit(User $user)
    {
        return view('users/edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
