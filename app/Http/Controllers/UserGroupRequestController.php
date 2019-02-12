<?php

namespace App\Http\Controllers;

use App\UserGroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\UserGroup;

class UserGroupRequestController extends Controller
{
    protected $validationRules = [
        'value' => 'required|numeric|min:0',
        'user_group_id' => 'required|numeric',
        'type' => 'required|numeric'
    ];
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
        $validator = Validator::make($request->all(), $this->validationRules);
        if ($validator->fails())
        {
            return back()->with('status',implode(' ', $validator->errors()->all()));
        } else {
            $groupRequest = new UserGroupRequest;
            $groupRequest->user_group_id = $request->user_group_id;
            $groupRequest->value = $request->value;
            $groupRequest->type = $request->type;
            $groupRequest->save();
            return back()->with('status','Your Request has been succsessfully created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserGroupRequest  $userGroupRequest
     * @return \Illuminate\Http\Response
     */
    public function show(UserGroupRequest $userGroupRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserGroupRequest  $userGroupRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGroupRequest $userGroupRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserGroupRequest  $userGroupRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserGroupRequest $userGroupRequest)
    {
        $userGroup = UserGroup::findOrFail($request->userGroupId);
        $userGroupRequest1 = UserGroupRequest::findOrFail($request->userGroupRequestId);
        if ($request->type == '0')
        {
            $userGroupRequest1->status = 1;
            $userGroup->withdrew_money+= $request->value;

        } elseif ($request->type == '1') {
            $userGroupRequest1->status = 1;
            $userGroup->supported_budget+=$request->value;
        }
        $userGroupRequest1->save();
        $userGroup->save();
        return redirect()->back()->with('success', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserGroupRequest  $userGroupRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGroupRequest $userGroupRequest)
    {
        //
    }
}
