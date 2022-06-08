<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Log;
use \App\Models\Group;
use \App\Models\Profile;
use \App\Models\User;

class AdminController extends Controller
{
    //
    function index()
    {
        $admins=User::all();

        return response()->json($admins, 200);
    }

    function usersCount()
    {
        $count=User::where('is_active', true)->count();

        return response()->json($count, 200);
    }

    function Count()
    {
        $count=User::where('is_active', true)->count();

        return response()->json($count, 200);
    }

    public function createAdmin(Request $request)
    {
        Log::alert("jay");
        $rules=$request->validate([
            'group_id' => 'required',
            'profile_id' =>'required'
        ]);

        //$rules['group_name'] = ucwords($request->group_name);
        //$id = $rules['group_id'];
        $profile_id = $rules['profile_id'];

        $group = Group::findOrFail($request->id);
        Log::alert($group);
       $dmin = $group->update([
                'profile_id' => $profile->id
        ]);

        return response()->json($admin, 201);
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

        $usr=Profile::findOrFail($id);
        $usr1=User::findOrFail($id);

        $usr1->is_active = false;
        $usr1->save();
        $usr->is_active = false;
        $usr->save();

        //Log::alert($usr);

       //Log::info($usr);

        return response()->json([
            'user' => $usr1,
            'profile' => $usr
        ], 201);

    }

    function birthday()
    {
        $day = date("d");
        $month = date("m");
        $like = "%-".$month."-" . $day . " %";

        $profiles = Profile::where('dob', 'like', $like)->get();

        return response()->json($birthdays, 201);
    }


}
