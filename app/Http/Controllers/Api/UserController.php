<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

//use App\Http\Requests\PasswordRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\GroupResource;
use App\Http\Resources\StudentStatusResource;
use App\Models\GroupRequest;
use App\Models\Status;
use App\Models\user_groups;
use App\Rules\CurrentPasswordCheckRule;
use App\Http\Resources\UserResource;
use App\Models\EditRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['returnStudents', 'status', 'UploadFile', 'getAllTeachers', 'studentsInGroup']);
    }

    public function index()
    {
        if (isset($_GET['query'])) {
            $search = $_GET['query'];
        } else {
            $search = null;
        }
        if ($search) {
            $students = User::orderBy('name', 'asc')->where('name', 'like', '%' . $search . '%')->where('role_id', 3)->paginate(10);
            if ($students->count() > 0) {
                $students->appends(['query' => $search]);
                return UserResource::collection($students);
            } else if ($students->count() === 0) {
                return response()->json('empty', 404);
            }
        } else {
            $students = User::orderBy('name', 'asc')->where("role_id", 3)->paginate(10);
            return UserResource::collection($students);
        }
    }

    // return all student status
    public function status()
    {
        return StudentStatusResource::collection(Status::paginate(10));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    //show user
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    //edit user
    public function editUser(User $user)
    {
        return UserResource::make($user);
    }

    // update user image
    public function updateUserImage(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }
        if ($request->hasFile('image')) {
            $image = $request->image;
            $avatar = $this->UploadImage($image);
        } else {
            $avatar = $user->image;
        }
        $user->image = $avatar;
        $user->save();
        return response()->json(['success' => 'Image Updated', 'data' => '/storage/images/users/' . $user->image],
            200);

    }

    // update user password
    public function updateUserPassword(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'min:6'],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ]);
        $current_password = Hash::check($request->old_password, $user->password);
        if ($current_password === false) {
            return response()->json(['errors' => 'The current password field does not match your password'], 404);
        }
        //validation
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 200);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json('Password Updated', 200);
    }

    // show request
    public function showRequest(User $user)
    {
        $change = EditRequest::where('user_id', $user->id)->first();
        return response()->json(['request' => $change, 'user' => $user], 200);
    }

    public function createRequest(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:6|confirmed',
            'code' => 'string|unique:users',
            'national_number' => 'string|unique:users',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 200);
        }

        // find user
        $user_id = $user->id;
        $user = User::where('id', $user_id)->first();
        //find edit user edit request
        $edit = EditRequest::where('user_id', $user->id)->first();
        //
        if ($request->hasFile('image')) {
            $image = $request->image;
            $avatar = $this->UploadImage($image);
        } else {
            $avatar = $user->image;
        }
        if ($edit) {
            $edit->name = isset($request->name) ? $request->name : $user->name;
            $edit->email = isset($request->email) ? $request->email : $user->email;
            $edit->code = isset($request->code) ? $request->code : $user->code;
            $edit->national_number = isset($request->national_number) ? $request->national_number : $user->national_number;
            $edit->status_id = isset($request->status) ? $request->status : $user->status_id;
            $edit->role_id = isset($request->role_id) ? $request->role_id : $user->role_id;
            $edit->user_id = $user_id;
            $edit->image = $avatar;
            $edit->save();
            $user->has_changes = 1;
            $user->save();
            return response()->json('Your Request Send', 200);
        } else {
            $edit_r = new EditRequest();
            $edit_r->name = isset($request->name) ? $request->name : $user->name;
            $edit_r->email = isset($request->email) ? $request->email : $user->email;
            $edit_r->code = isset($request->code) ? $request->code : $user->code;
            $edit_r->national_number = isset($request->national_number) ? $request->national_number : $user->national_number;
            $edit_r->status_id = isset($request->status) ? $request->status : $user->status_id;
            $edit_r->role_id = isset($request->role_id) ? $request->role_id : $user->role_id;
            $edit_r->user_id = $user_id;
            $edit_r->image = $avatar;
            $edit_r->save();
            $user->has_changes = 1;
            $user->save();
            return response()->json('Your Request Send', 200);
        }
    }

    //update user
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->has_changes = 0;
        $user->save();
        if ($user->password_change === 0) {
            EditRequest::destroy($request->change_id);
        }
        return response()->json('User Updated', 200);
    }

    //edit password request
    public function editPassword(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ]);
        // find user
        $user_id = $user->id;
        //current password
//        $current_password = Hash::check($request->old_password, $user->password);
//        if ($current_password === false) {
//            return response()->json(['errors' => 'The current password field does not match your password'], 200);
//        }
        //validation
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 200);
        }

        // update if auth user is super admin
        if (Auth::user()->role_id === 1) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json('User Updated', 200);
        }
        //find edit user edit request
        $edit = EditRequest::where('user_id', $user->id)->first();
        //
        if ($edit) {
            $edit->password = Hash::make($request->password);
            $edit->password_change = 1;
            $edit->save();
            $user->password_change = 1;
            $user->save();
            return response()->json('Your Request Send ', 200);
        } else {
            $edit_p = new EditRequest();
            $edit_p->password = Hash::make($request->password);
            $edit_p->password_change = 1;
            $edit_p->user_id = $user_id;
            $edit_p->save();
            $user->password_change = 1;
            $user->save();
        }
        return response()->json('Your Request Send ', 200);
    }

    //update password
    public function updatePassword(Request $request, User $user)
    {
        $user_p = EditRequest::where('user_id', $user->id)->first();
        $user->password = $user_p->password;
        $user->password_change = 0;
        $user->save();
        if ($user->has_changes === 0) {
            EditRequest::destroy($user_p->id);
        }
        return response()->json('User Updated', 200);
    }

    // delete request
    public function deleteRequest($id)
    {
        $change = EditRequest::find($id);
        $user = User::where('id', $change->user_id)->first();
        if ($change->password_change === 1) {
            $change->name = null;
            $change->email = null;
            $change->code = null;
            $change->national_number = null;
            $change->status = null;
            $change->role_id = null;
            $change->image = null;
            $change->save();
            $user->has_changes = 0;
            $user->save();
            return response()->json('Request Deleted', 200);
        } elseif ($change->password_change === 0) {
            $change->delete();
            $user->has_changes = 0;
            $user->save();
            return response()->json('Request Deleted', 200);
        }
    }

    // delete password request
    public function deletePasswordRequest($id)
    {
        $change = EditRequest::where('user_id', $id)->first();
        $user = User::where('id', $change->user_id)->first();
        if ($user->has_changes === 1) {
            $change->password = null;
            $change->save();
            $user->password_change = 0;
            $user->save();
            return response()->json('Request Deleted', 200);
        } elseif ($user->has_changes === 0) {
            $change->delete();
            $user->password_change = 0;
            $user->save();
            return response()->json('Request Deleted', 200);
        }
    }

    // delete user
    public function destroy(User $user)
    {
        if ($user->image !== 'default.png') {
            $image = $user->image;
            unlink(storage_path('app/public/images/users/' . $image));
            $user->delete();
        } elseif ($user->image === 'default.png') {
            $user->delete();
        }
        return response()->json('User Deleted', 200);

    }

    // return all user's groups
    public function userGroups()
    {
        $user = $_GET['user'];
        $groups = DB::table('chatrooms')->whereIn('id', function ($query) use ($user) {
            $query->from('user_groups')->select('group_id')->where('user_id', $user)->get();
        })->where('id','<>',1)->get();

        return response()->json(['groups' => $groups], 200);
    }

    // get all students in group
    public function studentsInGroup()
    {
        $group_id = $_GET['group_id'];
        $students = DB::table('users')->where('role_id', 3)->whereIn('id', function ($query) use ($group_id) {
            $query->from('user_groups')->where('group_id', $group_id)->select('user_id')->get();
        })->get();
        return response()->json(['students' => $students], 200);
    }

    ////
    public function userGroups2(Request $request)
    {
        $user = $request->user;
        $groups = DB::table('chatrooms')->whereIn('id', function ($query) use ($user) {
            $query->from('user_groups')->select('group_id')->where('user_id', $user)->get();
        })->get();
        $users = DB::table('users')->where('role_id', 4)->whereIn('id', function ($query2) use ($groups) {
            foreach ($groups as $i) {
                $query2->from('user_groups')->select('user_id')->where('group_id', $i->id)->get();
            }
        })->get();


        return response()->json(['groups' => $groups, 'users' => $users], 200);
    }

    //update user's groups

    public function updateUserGroups(Request $request)
    {
        $user_id=$request->user_id;
        $user=User::where('id',$user_id)->first();
        if($user->groups_requests ==1){
            return response()->json('This user already has request', 400);
        }
        if (Auth::user()->role_id === 1) {
            $groups = user_groups::where('user_id',$user_id)->where('is_active', 1)->get();
            foreach ($groups as $group) {

                if ($group->group_id !== 1) {
                    $group->delete();
                }
            }
            if ($request->groups) {
                foreach ($request->groups as $group) {
                    $userGroup = new user_groups();
                    $userGroup->user_id = $user->id;
                    $userGroup->group_id = $group;
                    $userGroup->is_active = 1;
                    $userGroup->save();
                }
            }
            return response()->json('User updated', 200);
        } elseif (Auth::user()->role_id === 2) {
            $uuid=rand(1000,9999);
            if ($request->groups) {
                foreach ($request->groups as $group) {
                    $request = new GroupRequest();
                    $request->user_id = $user->id;
                    $request->group_id = $group;
                    $request->uuid=$uuid;
                    $request->save();
                }
                $user->groups_request = 1;
                $user->save();
            }
        }
        return response()->json('Your request send successfully', 200);
    }

    public function getAllTeachers()
    {
        $teachers = User::where('role_id', 4)->get();
        return response()->json(['teachers' => $teachers], 200);
    }

    // get all user's groups with teachers from user token
    public function getUserGroups()
    {
        $user_id = Auth::guard('api')->user()->id;
        $groups = DB::table('chatrooms')->whereIn('id', function ($query) use ($user_id) {
            $query->from('user_groups')->select('group_id')->where('user_id', $user_id)->get();
        })->where('id','<>',1)->get();


        return response()->json(['groups' => ChatResource::collection($groups)], 200);

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

    public function UploadFile(Request $request)
    {
        $file = $request->file;
        //get file name with extention
        $filenameWithExt = $file->getClientOriginalName();
        //get just file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //GET EXTENTION
        $extention = $file->getClientOriginalExtension();
        //file name to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extention;
        //upload image
        $path = $file->storeAs('public/files', $fileNameToStore);
        $pathApi = '/storage/files/' . $fileNameToStore;
        return response()->json(['path' => $pathApi, 'extention' => $extention], 200);
    }
}
