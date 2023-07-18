<?php

namespace App\Http\Controllers;

use App\Models\user_groups;
use App\User;
use Illuminate\Http\Request;
use App\Models\Chatroom;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $rooms = Chatroom::orderBy('created_at','desc')->get();
        return view('chat.index', compact('rooms'));
    }

    public function create()
    {
        $teachers=User::where('role_id',4)->get();
        return view('chat.create',compact('teachers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string:max:255',
            'code' => 'required|min:3',
        ]);
        $rooms = new Chatroom();
        if ($request->selectDays == 1){
            $days = "Saturday | Monday | Wednesday";
        }else if ($request->selectDays == 2 ){
            $days = "Sunday | Tuesday | Thursday";
        }

        if (auth()->user()->hasRole('superAdmin')){
            $status = 1;

        }else if (auth()->user()->hasRole('admin')){
            $status = 0;
        }
        if($request->timeFrom > $request->timeTo){
            return redirect()->back()->withstatus(__("alerts.backend.group.validate_time"));
        }
        $rooms->groupName = $request->name;
        $rooms->code = $request->code;
        $rooms->days = $days;
        $rooms->daysId = $request->selectDays;
        $rooms->timeFrom = $request->timeFrom;
        $rooms->timeTo = $request->timeTo;
        $rooms->status = $status;
        $rooms->save();
        if ($request->teachers) {
            foreach ($request->teachers as $teacher) {
                $userGroup = new user_groups();
                $userGroup->user_id = $teacher;
                $userGroup->group_id = $rooms->id;
                $userGroup->save();
            }
        }
        return redirect(route('Chat.index'))->withstatus(__('alerts.backend.group.created' ));
    }

    public function show($id)
    {
        $group = ChatRoom::findOrFail($id);
        $arr = array('thisGroup' => $group);

        return view('chat.show', $arr);
    }

    public function editRoom(Request $request, $id)
    {
        $method = $request->method();
        echo $method;
        if ($request->isMethod('post')) {
            $editRoom = ChatRoom::findOrFail($id);
            if ($request->hasFile('image')) {
                $image = $request->image;
                $groupImage = $this->UploadImage($image);
            } else {
                $groupImage = $editRoom->image;
            }

            if ($request->selectDays == 1){
                $days = "Saturday | Monday | Wednesday";
            }else if ($request->selectDays == 2 ){
                $days = "Sunday | Tuesday | Thursday";
            }

            $editRoom->groupName = $request->name;
            $editRoom->code = $request->code;
            $editRoom->days = $days;
            $editRoom->daysId = $request->selectDays;
            $editRoom->timeFrom = $request->timeFrom;
            $editRoom->timeTo = $request->timeTo;
            $editRoom->image =$groupImage;
            $editRoom->save();
            return redirect(route('Chat.index'))->withstatus(__('alerts.backend.group.updated'));
        } else {
            $editRoom = ChatRoom::findOrFail($id);
            $arr = array('roomView' => $editRoom);
            return view('chat.edit', $arr);
        }
    }

    public function groupUser(Chatroom $room)
    {
        $userGroup=user_groups::where('group_id',$room->id)->paginate(10);
        return view('chat.groupUser', compact('room','userGroup'));
    }
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
        $path = $image->storeAs('public/images/groups/', $fileNameToStore);
        return $fileNameToStore;
    }

    public function activeRoom($id){
        $group = ChatRoom::findOrFail($id);
        $group->status = 1;
        $group->save();

                    $userGroup = new user_groups();
                    $userGroup->user_id = auth()->user()->id;
                    $userGroup->group_id = $id;
                    $userGroup->save();

        return redirect(route('Chat.index'))->withstatus(__('Group is activated now'));
    }
        public function notification(){


//        if ($request->userId != auth()->user()->id){
//            if ((auth()->user()->role->id < 3)||(auth()->user()->id * 1000000 == $request->roomId)){
//                console.log ('here');
//            }
//        }
        echo'
        <script>
            alert("here");
        </script>
        ';
        return response()->json('ss', 200);
    }

}
