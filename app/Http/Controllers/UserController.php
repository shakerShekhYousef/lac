<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Chatroom;
use App\Models\EditRequest;
use App\Models\GroupRequest;
use App\Models\Role;
use App\Models\Status;
use App\Models\user_groups;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use phpseclib\Crypt\Random;

class UserController extends Controller
{

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function messages()
    {

        $messages = User::where('id', '!=', auth()->user()->id)->paginate(10);
//        $unreadMessage = DB::table('messages')
//                 ->select('reading',DB::raw('count(*)total'))
//                 ->where('reading' , 1)
//                 ->where('idSender',)
//                 ->groupBy('reading')
//                 ->first();

        //$messages = User::paginate(9);
        return view('users.messages', compact('messages'));
    }


    public function conversation($id)
    {
        $student = User::findOrFail($id);
//		$admins = User::where('id', '<', '3')->get();
        //$arr = array('thisStudent' => $student);
        //return view('users.conv', $arr);
        return view('users.conv', compact('student'));
    }


    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            $roles = Role::all()->except([1, 2]);
        } elseif (auth()->user()->hasRole('superAdmin')) {
            $roles = Role::all()->except(1);
        }
        $statuses = Status::all();
        $groups = Chatroom::all();
        return view('users.create', compact('roles', 'statuses', 'groups'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
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
        if ($email = $request->email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                return redirect()->back()->withStatus('error', $emailErr);
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
        if ($user->role_id !== 4) {
            $userGroup = user_groups::create([
                'user_id' => $user->id,
                'group_id' => 1,
                'is_active' => 1,
            ]);

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
        return redirect()->back()->withstatus(__('alerts.backend.users.created'));
    }

    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    public function edit(User $user)
    {
        if (auth()->user()->hasRole('admin')) {
            $roles = Role::all()->except([1, 2]);
        } elseif (auth()->user()->hasRole('superAdmin')) {
            $roles = Role::all()->except(1);
        }
        $statuses = Status::all();
        return view('users.edit', compact('user', 'roles', 'statuses'));
    }

    // create request for edit
    public function createRequest(Request $request)
    {

        if ($request->email !== null) {
            $this->validate($request, [
                'email' => 'string|email|max:255|unique:users',
            ]);

        }
        // find user
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        //validation
        $national_number = User::where('national_number', $request->national_number)->where('id', '<>', $user_id)->get();
        $code = User::where('code', $request->code)->where('id', '<>', $user_id)->get();
        if ($national_number->count() > 0) {
            return redirect()->back()->withstatus(__('alerts.backend.users.national_number'));
        }
        if ($code->count() > 0) {
            return redirect()->back()->withstatus(__('alerts.backend.users.code'));
        }
        //end validation
        // update if auth user is super admin
        if (Auth::user()->role_id === 1) {
            $user->update($request->all());
            $user->status_id = $request->status;
            $user->save();
            return redirect()->route('user.index')->withstatus(__('alerts.backend.users.updated'));
        }
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
            return redirect()->back()->withPasswordStatus(__('alerts.backend.users.request_send'));
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
            return redirect()->back()->withstatus(__('alerts.backend.users.request_send'));

        }
    }

    // show request
    public function showRequest(User $user)
    {
        $change = EditRequest::where('user_id', $user->id)->first();
        return view('users.showRequest', compact('change', 'user'));
    }

    public function editPassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ]);
        // find user
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        //current password
//        $current_password = Hash::check($request->old_password, $user->password);
//        if ($current_password === false) {
//            return redirect()->back()->withStatus(__('alerts.backend.users.current_password'));
//        }
        // update if auth user is super admin
        if (Auth::user()->role_id === 1) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->withPasswordStatus(__('alerts.backend.users.updated'));
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
            return redirect()->back()->withPasswordStatus(__('alerts.backend.users.request_send'));
        } else {
            $edit_p = new EditRequest();
            $edit_p->password = Hash::make($request->password);
            $edit_p->password_change = 1;
            $edit_p->user_id = $user_id;
            $edit_p->save();
            $user->password_change = 1;
            $user->save();
        }
        return redirect()->back()->withPasswordStatus(__('alerts.backend.users.request_send'));

    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->status_id = $request->status;
        $user->has_changes = 0;
        $user->save();
        if ($user->password_change === 0) {
            EditRequest::destroy($request->change_id);
        }
        return redirect()->route('user.index')->withstatus(__('alerts.backend.users.updated'));
    }

    public function updatePassword(Request $request)
    {
        $user_id = $request->user_id;
        $user_p = EditRequest::where('user_id', $user_id)->first();
        $user = User::where('id', $user_id)->first();
        $user->password = $user_p->password;
        $user->password_change = 0;
        $user->save();
        if ($user->has_changes === 0) {
            EditRequest::destroy($user_p->id);
        }
        return redirect()->route('user.index')->withstatus(__('alerts.backend.users.updated'));
    }

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
            return redirect()->route('user.index')->withstatus(__('alerts.backend.users.edit_request_delete'));
        } elseif ($change->password_change === 0) {
            $change->delete();
            $user->has_changes = 0;
            $user->save();
            return redirect()->route('user.index')->withstatus(__('alerts.backend.users.edit_request_delete'));
        }
    }

    public function deletePasswordRequest(Request $request)
    {
        $user_id = $request->user_id;
        $change = EditRequest::where('user_id', $user_id)->first();
        $user = User::where('id', $change->user_id)->first();
        if ($user->has_changes === 1) {
            $change->password = null;
            $change->save();
            $user->password_change = 0;
            $user->save();
            return redirect()->route('user.index')->withstatus(__('alerts.backend.users.edit_request_delete'));
        } elseif ($user->has_changes === 0) {
            $change->delete();
            $user->password_change = 0;
            $user->save();
            return redirect()->route('user.index')->withstatus(__('alerts.backend.users.edit_request_delete'));
        }
    }

    public function destroy(User $user)
    {

        if ($user->image !== 'default.png') {
            $image = $user->image;
            unlink(storage_path('app/public/images/users/' . $image));
            $user->delete();
        } elseif ($user->image === 'default.png') {
            $user->delete();
        }
        return redirect()->back()->withstatus(__('alerts.backend.users.deleted'));

    }

    public function updateGroupsView(User $user)
    {
        $groups_in = DB::table('chatrooms')->whereIn('id', function ($query) use ($user) {
            $query->from('user_groups')->select('group_id')->where('user_id', $user->id)->where('is_active', 1)->get();
        })->get();
        $groups_out = DB::table('chatrooms')->whereNotIn('id', function ($query) use ($user) {
            $query->from('user_groups')->select('group_id')->where('user_id', $user->id)->where('is_active', 1)->get();
        })->get();
        // dd($groups_in);
        return view('users.updateGroup', compact('groups_in', 'groups_out', 'user'));
    }

    // show user group update request
    public function userGroupsRequest(User $user)
    {
        $groups = GroupRequest::where('user_id', $user->id)->get();
        $uuid = GroupRequest::where('user_id', $user->id)->select('uuid')->first();
        $groups_out = DB::table('chatrooms')->whereNotIn('id', function ($query) use ($user) {
            $query->from('user_groups')->select('group_id')->where('user_id', $user->id)->where('is_active', 1)->get();
        })->get();
        return view('users.userGroupsRequest', compact('groups', 'groups_out', 'user', 'uuid'));
    }

    // approve user group update request
    public function activeUserGroups(Request $request)
    {
        $user_id = $request->user;
        $groups = $request->groups;
        $userGroups = user_groups::where('user_id', $user_id)->get();
        if ($userGroups) {
            foreach ($userGroups as $group) {
                if ($group->group_id !== 1) {
                    $group->delete();
                }
            }
        }
        foreach ($groups as $group) {
            $GroupR = GroupRequest::where('user_id', $user_id)->where('group_id', $group)->first();

            $userGroup = new user_groups();
            $userGroup->user_id = $user_id;
            $userGroup->group_id = $group;
            $userGroup->is_active = 1;
            $userGroup->save();
            $GroupR->delete();
            $user = DB::table('users')->where('id', $user_id)->update([
                'groups_request' => 0
            ]);
        }
        return redirect()->route('indexUserGroupRequests')->withstatus(__('alerts.backend.users.updated'));
    }

    public function updateGroups(User $user, Request $request)
    {
        if (Auth::user()->role_id === 1) {
            $groups = user_groups::where('user_id', $user->id)->where('is_active', 1)->get();
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
            return redirect()->back()->withstatus(__('alerts.backend.users.updated'));
        }
        elseif (Auth::user()->role_id === 2) {
            $uuid = rand(1000, 9999);
            if ($request->groups) {
                foreach ($request->groups as $group) {
                    $request = new GroupRequest();
                    $request->user_id = $user->id;
                    $request->group_id = $group;
                    $request->uuid = $uuid;
                    $request->save();
                }
                $user->groups_request = 1;
                $user->save();
                return redirect()->back()->withstatus(__('alerts.backend.users.request_send'));
            }
        }
    }
// user update requests
    public function userUpdateRequests()
    {
        $requests = EditRequest::all();
        $users = [];
        foreach ($requests as $request) {
            $user = DB::table('users')->where('id', $request->user_id)->where('has_changes', 1)->first();
            array_push($users, $user);
        }
        return view('requests.updateUserRequests', compact('users'));
    }

//delete user update request
    public function deleteGroupRequest(Request $request)
    {

        $userRequests = GroupRequest::where('uuid', $request->uuid)->get();
        foreach ($userRequests as $userRequest) {
            $userRequest->delete();
        }
        $user = User::where('id', $request->user_id)->first();
        $user->groups_request = 0;
        $user->save();
        return redirect()->route('indexUserGroupRequests')->withstatus(__('alerts.backend.users.edit_request_delete'));
    }

    public function userUpdatePasswordRequests()
    {
        $requests = EditRequest::all();
        $users = [];
        foreach ($requests as $request) {
            $user = DB::table('users')->where('id', $request->user_id)->where('password_change', 1)->first();
            array_push($users, $user);
        }
        return view('requests.updatePasswordRequests', compact('users'));
    }

    //return all users groups update requests
    public function indexUserGroupRequests()
    {
        $requests = DB::table('group_requests')->distinct('user_id')->get();
        $users = $user = DB::table('users')->where('groups_request', 1)->distinct()->get();
        return view('requests.updateUserGroups', compact('users'));
    }
    //counter
    public function counter(){
        $students=User::where('role_id',3)->get();
        return view('users.studentActivities',$students,compact('students'));
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

    public function fileImport(Request $request)
    {
        Excel::import(new User, $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport()
    {
        return Excel::download(new UsersExport, 'user_new.xlsx');
    }
}
