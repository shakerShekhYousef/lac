<?php

namespace App\Http\Controllers\Api;

use App\Events\notifications\NotificationCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\HrdResource;
use App\Models\Hrd;
use App\Models\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HrdController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return HrdResource::collection(Hrd::paginate(10));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'name_ar'=>'required|string',
            'description'=>'required|string',
            'description_ar'=>'required|string'
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),200);
        }
        $hdrcontent=new Hrd();
        $hdrcontent->name=$request->name;
        $hdrcontent->name_ar=$request->name_ar;
        $hdrcontent->description=$request->description;
        $hdrcontent->description_ar=$request->description_ar;
        $hdrcontent->save();
        if ($hdrcontent) {
            //notification structure
            $message = 'New HR section is added !';
            $users=User::all()->except(['1','2']);
            foreach ($users as $receiver){
                $receiver_id=$receiver->id;
                $notification = Notification::create([
                    'title' => 'HR Section',
                    'text' => $message,
                    'user_id'=>$receiver_id,
                ]);
                event(new NotificationCreatedEvent($notification,$receiver_id));
            }
            return response()->json('Content Created',200);
        }

    }


    public function show(Hrd $hrd)
    {
        return HrdResource::make($hrd);
    }

    public function edit(Hrd $hrd)
    {
        return HrdResource::make($hrd);
    }


    public function update(Request $request, Hrd $hrd)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'string',
            'name_ar'=>'string',
            'description'=>'string',
            'description_ar'=>'string'
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),200);
        }
        $hrd->name=$request->name;
        $hrd->name_ar=$request->name_ar;
        $hrd->description=$request->description;
        $hrd->description_ar=$request->description_ar;
        $hrd->save();
        return response()->json('Content Updated',200);
    }


    public function destroy(Hrd $hrd)
    {
        $hrd->delete();
        return response()->json('Content Deleted',200);
    }
}
