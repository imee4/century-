<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Log;
use \App\Models\Profile;
use \App\Models\Group;
use \App\models\GroupMember;

class UserController extends Controller
{
    function store(Request $request)
    {
        $rules=$request->validate([
            'name' => 'required|min:3|max:200',
            'email' => 'required|email|min:6',
            'phone_number' => 'required|min:11|max:13',
            'gender' => 'min:4|max:20',
            'dob' => 'required|min:4'
        ]);

        //$rules['name'] = ucwords($request->name);
        $admin_id = auth()->user()->profile_id;
        Log::info($admin_id);
        $group = Group::findOrFail($admin_id);
        $group_id = $group->id;
        $rules['user_type_id'] = 3;

        $profile = Profile::create($rules);

        $group_member = GroupMember::create([
            'profile_id' => $profile->id,
            'group_id' => $group_id,
            'is-active' => true
        ]);

        return response()->json([
            'profile' =>$profile,
            'group_member' => $group_member
            ], 201);
    }

    function index()
    {
        $id = auth()->user()->profile_id;

        $group = Group::where('admin_id', $id)->first();
        $users = GroupMember::where('group_id', $group->id)->get();

        return response()->json($users, 201);

    }

    function show(Request $request)
    {
        $id = $request->id;
        $user = Profile::findOrFail($id);

        return response()->json($user, 200);
    }

    function update(Request $request)
    {
        $id = $request->id;

        $user=Profile::findOrFail($id);

        $user->is_active = false;
        $user->save();

        return response()->json($user, 201);

    }




}
