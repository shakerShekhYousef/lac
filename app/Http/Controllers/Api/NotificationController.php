<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\user_groups;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //send notification to a group

    public function sendNotificationGroup(){
        $group_id=$request->group_id;
        $users=user_groups::with('users')->where('group_id',1)->get();
        return response()->json('ddd');
    }

}
