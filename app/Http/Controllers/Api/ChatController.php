<?php

namespace App\Http\Controllers\Api;

use App\Events\notifications\NotificationCreatedEvent;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Resources\GroupResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\user_groups;
use App\Models\Chatroom;
use App\User;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['index', 'sendNotification', 'sendNotificationGroup']);
    }

    public function index()
    {
        return GroupResource::collection(\App\Models\Chatroom::paginate(10));
    }


    public function createGroup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string:max:255',
            'code' => 'required|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $rooms = new Chatroom();
        if ($request->hasFile('image')) {
            $image = $request->image;
            $groupImage = $this->UploadImage($image);
        } else {
            $groupImage = 'default.png';
        }
        if ($request->selectDays == 1) {
            $days = "Saturday | Monday | Wednesday";
        } else if ($request->selectDays == 2) {
            $days = "Sunday | Tuesday | Thursday";
        }

        if (auth()->user()->hasRole('superAdmin')) {
            $status = 1;

        } else if (auth()->user()->hasRole('admin')) {
            $status = 0;
        }
        $rooms->groupName = $request->name;
        $rooms->code = $request->code;
        $rooms->days = $days;
        $rooms->daysId = $request->selectDays;
        $rooms->timeFrom = $request->timeFrom;
        $rooms->timeTo = $request->timeTo;
        $rooms->image = $groupImage;
        $rooms->status = $status;
        $rooms->save();
        $userGroup = new user_groups();
        $userGroup->user_id = $request->teacher_id;
        $userGroup->group_id = $rooms->id;
        $userGroup->save();
        if ($rooms) {
            return response()->json('Group Created', 200);
        }
    }

    //send notification

    public function sendNotification(Request $request)
    {
        //notification structure
        $sender_id = $request->sender_id;
        $sender = User::where('id', $sender_id)->first();
        $message = 'New message from ' . $sender->name;
        $receiver_id = $request->receiver_id;
        $notification = Notification::create([
            'title' => 'New Message !',
            'text' => $message,
            'user_id' => $receiver_id,
        ]);
        event(new NotificationCreatedEvent($notification, $receiver_id));
        return response()->json('success', 200);
    }

    //send notification to a group
    public function sendNotificationGroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required',
            'sender_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $sender_id = $request->sender_id;
        $sender = User::where('id', $sender_id)->first();
        $group = Chatroom::where('id', $request->group_id)->first();
        $users = user_groups::where('group_id', $request->group_id)->where('user_id', '<>', $sender_id)->select('user_id')->get();
        foreach ($users as $user) {
            $receiver_id = $user->user_id;
            $message = 'New message from ' . $sender->name . ' in group ' . $group->groupName;
            $notification = Notification::create([
                'title' => 'New Message !',
                'text' => $message,
                'user_id' => $receiver_id,
            ]);
            event(new NotificationCreatedEvent($notification, $receiver_id));
        }
        return response()->json('success', 200);
    }

public
function UploadImage($image)
{
    //get file name with extention
    $filenameWithExt = $image->getClientOriginalName();
    //get just file name
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    //GET EXTENTION
    $extention = $image->getClientOriginalExtension();
    //file name to store
    $fileNameToStore = $filename . '_' . time() . '.' . $extention;
    //upload image
    $path = $image->storeAs('public/images/groups/', $fileNameToStore);
    return $fileNameToStore;
}

public
function notification(Request $request)
{
    if ($request->userId != auth()->user()->id) {
        if ((auth()->user()->role->id < 3) || (auth()->user()->id * 1000000 == $request->roomId)) {
            console . log('here');
            echo '<script>alert("here")</script>';
        }
    }

}


//	    public function alert($name){
//        echo"<script>alert('$name')</script>";
//    }
//
//    public function enterName($name){
//    echo"
//    <script src='".asset("chatcord")."/public/js/jquery.js'></script>
//    <script src='".asset("chatcord")."/public/js/socket.io.js'></script>
//    <script>
//        var io = io('http://127.0.0.1:3000');
//        io.emit('user_connected', '".$name."');
//        sender = '".$name."';
//        alert('".$name."');
//    </script>";
//    }
//
//    //Lister to user from server
//    public function ListenUser(){
//        echo"<script src='".asset("chatcord")."/public/js/jquery.js'></script>
//    <script src='".asset("chatcord")."/public/js/socket.io.js'></script>
//    <script>
//        var io = io('http://127.0.0.1:3000');
//        io.on('user_connected', function (username) {
//            alert(username);
//        });
//    </script>";
//    }
}
