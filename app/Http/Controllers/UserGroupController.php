<?php

namespace App\Http\Controllers;

use App\UserGroup;
use App\User;
use App\UserGroupRequest;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $users = User::where('id', $request->input('user'))->get();
        foreach ($users as $user){
            $user->groups()->attach($request->group_id);
        }
        return redirect()->back()->with('success', 'Success, !');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user_groups  $user_groups
     * @return \Illuminate\Http\Response
     */
    public function show(user_groups $user_groups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user_groups  $user_groups
     * @return \Illuminate\Http\Response
     */
    public function edit(user_groups $user_groups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user_groups  $user_groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user_groups $user_groups)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user_groups  $user_groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_groups $user_groups)
    {
        //
    }
}
