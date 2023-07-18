<?php

namespace App\Http\Controllers\Api\auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\user_groups;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['login','store']);
    }

    public function index()
    {
        return UserResource::collection(User::paginate(9));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->code) {
            $this->validate($request, [
                'code' => 'unique:users',
            ]);
        }
        if ($request->national_number) {
            $this->validate($request, [
                'national_number' => 'unique:users',
            ]);
        }
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        if ($request->email != null) {
            $user = User::where('email', $request->email)->first();
            if ($user != null) {
                return response()->json(['errors' => 'the email is been taken'], 400);
            }
        }
        if ($request->national_number != null) {
            $user = User::where('national_number', $request->national_number)->first();
            if ($user != null) {
                return response()->json(['errors' => 'the national number must be unique'], 400);
            }
        }
        if ($request->code != null) {
            $user = User::where('code', $request->code)->first();
            if ($user != null) {
                return response()->json(['errors' => 'the code must be unique'], 400);
            }
        }
        if ($email = $request->email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                return response()->json(['errors'=>$emailErr],400);
            }
        }
        if ($request->hasFile('image')) {
            $image = $request->image;
            $avatar = $this->UploadImage($image);
        } else {
            $avatar = 'default.png';
        }
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->code = $request->code;
        $user->national_number = $request->national_number;
        $user->status_id = $request->status;
        $user->role_id = $request->role_id;
        $user->image = $avatar;
        $user->save();
        if($user->role_id !== 4){
            $userGroup=new user_groups();
            $userGroup->user_id=$user->id;
            $userGroup->group_id=1;
            $userGroup->is_active=1;
            $userGroup->save();
        }
        if ($request->groups){
            foreach ($request->groups as $group) {
                $userGroup = new user_groups();
                $userGroup->user_id = $user->id;
                $userGroup->group_id = $group;
                $userGroup->is_active=1;
                $userGroup->save();
            }
        }
        if ($user) {
            return response()->json('User Created', 200);
        }

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 200);
        }
        $credentials = request(['national_number', 'password']);
        $emailCredentials = request(['email', 'password']);
        if (Auth::attempt($credentials) || Auth::attempt($emailCredentials)) {
            // if user status !== {active or }
            $user=\App\User::where('email',$request->email)->first();
            $user->count_login=$user->count_login + 1;
            $user->save();
            if (Auth::user()->role->name === "student") {
                switch (Auth::user()->status_id) {
                    case 3 :
                        return response()->json('You do not have permission to log in', 401);
                        break;
                    case 4 :
                        return response()->json('You do not have permission to log in', 401);
                        break;
                    case 5 :
                        return response()->json('You do not have permission to log in', 401);
                        break;
                    default :
                        break;
                }
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addYear(100);
            }
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
        return response()->json(['message' => 'Login Failed'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user()
    {
        return UserResource::make(Auth::user());
    }
    // Upload image function
    public function UploadImage($image)
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
        $path = $image->storeAs('public/images/users/', $fileNameToStore);
        return $fileNameToStore;
    }

}
