<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentRequestResource;
use App\Models\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentRequestController extends Controller
{

    public function index()
    {
        return StudentRequestResource::collection(\App\Models\StudentRequest::paginate(10));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type_procedure_id' => 'required',
            'reason' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }
        $student_r = new StudentRequest();
        $student_r->student=Auth::user()->name;
        $student_r->type_procedure_id=$request->type_procedure_id;
        $student_r->reason=$request->reason;
        $student_r->save();
        return response()->json('Your Request Created',200);
    }


    public function show(StudentRequest $studentRequest)
    {
        return response()->json($studentRequest,200);
    }



    public function forward(StudentRequest $studentRequest,Request $request)
    {

        $studentRequest->forward_to=$request->admin_id;
        $studentRequest->save();
        return response()->json('success',200);
    }

    public function destroy(StudentRequest $studentRequest)
    {
        $studentRequest->delete();
        return response()->json('Request Deleted',200);
    }
}
