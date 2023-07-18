<?php

namespace App\Http\Controllers\Api;

use App\Models\Device;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

//FCM
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FirebaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['getUserToken','sendToOne','sendToGroup']);
    }
    // create device token
    public function createToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firebase_token' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }
        $user_id = Auth::guard('api')->user()->id;
        if ($user_id === null) {
            return response()->json('Please enter user token ', 200);
        }
        $deviceToken=Device::where('user_id',$user_id)->where('firebase_token',$request->firebase_token)->first();
        if($deviceToken){
            return response()->json('token submitted', 200);
        }
        $device = new Device();
        $device->firebase_token = $request->firebase_token;
        $device->user_id = Auth::user()->id;
        $device->save();
        return response()->json('token submitted', 200);
    }

    // delete token
    public function deleteToken(Request $request)
    {
        $user_firebasetoken = $request->firebase_token;
        $token_firebase = Device::where('firebase_token', $user_firebasetoken)->where('user_id', Auth::guard('api')->id())->first();
        if ($token_firebase) {
            $token_firebase->delete();
            return response()->json('token deleted', 200);
        } else {
            return response()->json('token does not exist', 404);
        }
    }

    // get user's token

    public function getUserToken()
    {

        $user_id = $_GET['user_id'];
        $tokens = DB::table('devices')->where('user_id', $user_id)->select('id', 'firebase_token')->get();
        if ($tokens->count() > 0) {
            return response()->json($tokens, 200);
        } else {
            return response()->json('user not found', 404);
        }
    }

    // send notification to user

//    public function sendToOne()
//    {
//        $optionBuilder = new OptionsBuilder();
//        $optionBuilder->setTimeToLive(60 * 20);
//        $notificationBuilder = new PayloadNotificationBuilder('Hello User');
//        $notificationBuilder->setBody('welcome')->setSound('default');
//        $dataBuilder = new PayloadDataBuilder();
//        $dataBuilder->addData(['a_data' => 'my_data']);
//        $option = $optionBuilder->build();
//        $notification = $notificationBuilder->build();
//        $data = $dataBuilder->build();
//        $token = 'hhjhkgbhjlbbhjbljkhbl';
//        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
//        return $downstreamResponse->numberSuccess();
//    }
//
//    // send notification to group
//    public function sendToGroup()
//    {
//        $optionBuilder = new OptionsBuilder();
//        $optionBuilder->setTimeToLive(60 * 20);
//        $notificationBuilder = new PayloadNotificationBuilder('Hello User');
//        $notificationBuilder->setBody('welcome')->setSound('default');
//        $dataBuilder = new PayloadDataBuilder();
//        $dataBuilder->addData(['a_data' => 'my_data']);
//        $option = $optionBuilder->build();
//        $notification = $notificationBuilder->build();
//        $data = $dataBuilder->build();
//        $tokens = DB::table('devices')->pluck('firebase_token')->toArray();
//        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
//        return $downstreamResponse->numberSuccess();
//    }


}
