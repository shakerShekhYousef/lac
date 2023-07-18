<?php

namespace App\Http\Controllers;

use App\Events\notifications\NotificationCreatedEvent;
use App\Models\Hrd;
use App\Models\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HrdController extends Controller
{

    public function index()
    {
        $hrdcontent=Hrd::orderBy('created_at','desc')->get();
        return view('hrd.index',compact('hrdcontent'));
    }


    public function create()
    {
        return view('hrd.create');
    }


    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
           'name'=>'required|string',
           'name_ar'=>'required|string',
           'description'=>'required|string',
           'description_ar'=>'required|string'
        ]);
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
            return redirect()->back()->withstatus(__('alerts.backend.hrd.created'));
        }

    }


    public function show(Hrd $hrd)
    {
        return view('hrd.show',compact('hrd'));
    }


    public function edit(Hrd $hrd)
    {
        return view('hrd.edit',compact('hrd'));
    }


    public function update(Request $request, Hrd $hrd)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'string',
            'name_ar'=>'string',
            'description'=>'string',
            'description_ar'=>'string'
        ]);
        $hrd->name=$request->name;
        $hrd->name_ar=$request->name_ar;
        $hrd->description=$request->description;
        $hrd->description_ar=$request->description_ar;
        $hrd->save();
        return redirect()->back()->withstatus(__('alerts.backend.hrd.updated'));

    }

    public function destroy(Hrd $hrd)
    {
        $hrd->delete();
        return redirect()->back()->withstatus(__('alerts.backend.hrd.deleted'));
    }
}
