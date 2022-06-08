<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Group;

class GroupController extends Controller
{
    function index()
    {
        $groups = Group::all();

        return response()->json($groups, 201);
    }

    function register(Request $request)
    {
        $rules=$request->validate([
            'group_name' => 'required|min:3|max:250',
            'profile_id' => 'min:1'
        ]);

        $group = Group::create($rules);
        return response()->json($group, 201);

    }

    function show(Request $request)
    {
        $id = $request->id;
        $group = Group::findOrFail($id);

        return response()->json($group, 201);
    }

    function update(Request $request)
    {
        $id = $request->id;
        $grp = Group::findOrFail($id);

        $group = $grp->update( ['is_active' => false]);

        return response()->json($group, 201);

    }
}
