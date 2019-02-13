<?php

namespace App\Http\Controllers;

use App\GroupConsumption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupConsumptionController extends Controller
{
    protected $validationRules = [
        'name' => 'required',
        'total_fee' => 'required|numeric|min:0',
        'quantity' => 'required',
        'type' => 'required'
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
        }
        $groupConsumption = new GroupConsumption;
        $groupConsumption->group_id = $request->group_id;
        $groupConsumption->name = $request->name;
        $groupConsumption->quantity = $request->quantity;
        $groupConsumption->type = $request->type;
        $groupConsumption->total_fee = $request->total_fee;
        $groupConsumption->user_id = $request->user_id;
        $groupConsumption->save();
        return response()->json($groupConsumption);
    }


    public function show(GroupConsumption $groupConsumption)
    {
        //
    }


    public function edit(GroupConsumption $groupConsumption)
    {
        return view('group_consumptions/edit', ['groupConsumption' => $groupConsumption]);
    }


    public function update(Request $request, GroupConsumption $groupConsumption)
    {
        $validator = Validator::make($request->all(), $this->validationRules);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $groupConsumption = GroupConsumption::findOrFail($groupConsumption->id);
        $groupConsumption->group_id = $request->group_id;
        $groupConsumption->name = $request->name;
        $groupConsumption->quantity = $request->quantity;
        $groupConsumption->type = $request->type;
        $groupConsumption->total_fee = $request->total_fee;
        $groupConsumption->user_id = $request->user_id;
        $groupConsumption->save();
        return redirect()->route('groups.show', $groupConsumption->group_id);
    }


    public function destroy(GroupConsumption $groupConsumption)
    {

        $groupConsumption = GroupConsumption::findOrFail($groupConsumption->id);
        $groupConsumption->destroy($groupConsumption->id);
        return redirect()->route('groups.show', $groupConsumption->group_id);
    }
}
