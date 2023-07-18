<?php

namespace App\Http\Controllers;

use App\Models\StudentRequest;
use App\User;
use Illuminate\Http\Request;

class StudentRequestController extends Controller
{

    public function index()
    {
        $studentRequests = StudentRequest::orderBy('created_at','desc')->get();
        return view('studentRequests.index', compact('studentRequests'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(StudentRequest $studentRequest)
    {
        $admins = User::where('role_id', 2)->get();

        return view('studentRequests.show',compact('studentRequest','admins'));
    }
    //mark as done
    public function done(StudentRequest $studentRequest){
        $studentRequest->update([
            'is_done'=>1
        ]);
        return redirect()->back();

    }

    public function forward(StudentRequest $studentRequest ,Request $request){

        $studentRequest->forward_to=$request->admin_id;
        $studentRequest->save();
        return redirect()->back()->withStatus(__('alerts.backend.student-request.forward'));
    }

    public function adminIndex(){
        $user=auth()->user()->id;
        $studentRequests = StudentRequest::where('forward_to',$user)->paginate(9);
        return view('studentRequests.adminIndex', compact('studentRequests'));
    }

    public function destroy($id)
    {
        //
    }
}
