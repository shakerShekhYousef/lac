<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\UserGroups;
use App\Models\Chatroom;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupsController extends Controller
{

    public function index()
    {

        $groups=Chatroom::orderBy('created_at','desc')->get();
        return view('userGroups.index',compact('groups'));
    }

    public function addUser(Request $request)
    {
        dd($request->room);
       $users=DB::table('user_groups')->select('user_id')->where('group_id',$request->room)->get();
        dd($users);
    }


    public function store(Request $request)
    {

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
