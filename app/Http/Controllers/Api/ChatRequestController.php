<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatRequestController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $chatRequest=new ChatRequest();
        $chatRequest->user_id=Auth::user()->id;
        $chatRequest->save();
        if($chatRequest){
            return response()->json('Your request send successfully',200);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(ChatRequest $request)
    {

    }
    public function showRequest()
    {
        $chatRequest=ChatRequest::where('user_id',\auth('api')->user()->id)->first();
        if ($chatRequest){
            return response()->json(['data'=>$chatRequest],200);
        }else{
            return response()->json('empty',404);
        }
    }
}
