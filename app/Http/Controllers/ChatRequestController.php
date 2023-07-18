<?php

namespace App\Http\Controllers;

use App\Models\ChatRequest;
use Illuminate\Http\Request;

class ChatRequestController extends Controller
{

    public function index()
    {
        $chatRequests=ChatRequest::orderBy('created_at','desc')->get();
        return view('chatRequest.index',compact('chatRequests'));
    }

    //confirm request
    public function confirm(ChatRequest $chatRequest){
        $chatRequest->update([
            'confirm'=>1
        ]);
        return redirect()->route('conversation',$chatRequest->user_id);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatRequest $chatRequest)
    {
        $chatRequest->delete();
        return redirect()->back()->withstatus(__('Request deleted successfully'));
    }
}
