<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use \App\Models\Profile;
use \App\models\User;
use \App\models\Group;

class EmailController extends Controller
{
    //
    function store(Request $request)
    {
        $rules=$request->validate([
            'name' => 'required|min:3|max:200',
            'email' => 'required|email|min:6',
            'phone_number' => 'required|min:11|max:13',
            'gender' => 'min:4|max:20',
            'dob' => 'required|min:5',
        ]);
        Log::Info("message");
        $rules['password'] = bcrypt($request->password);
        //$rules['name'] = ucwords($request->name);

        $profile = Profile::create($rules);

        if(!$request->password =="")
        {


            $user = User::create([
                'email' => $profile->email,
                'password' => bcrypt($request->password),
                'user_type_id' => 2,
                'profile_id' => $profile->id
            ]);

            $id = $request->group_id;
            $grp = Group::findOrFail($id);

            $group=$grp->update([
                'admin_id' => $user->id
            ]);

            $details = [
                'tittle' => 'My Tittle',
                // 'id' => $request->profile_id
            ];

            //Log::debug($details);

            try {
                //Mail::to($request->email)->queue(new App\Mail\NotificationMail($details));
                Log::info("Email Sent Successfully!!!");
            } catch (\Throwable $e) {
                throw $e;
            }

            return response()->json([
                'profile' => $profile,
                'user' => $user,
                'group' =>$group
            ], 201);
        }
        return response()->json($profile, 201);
    }

}
