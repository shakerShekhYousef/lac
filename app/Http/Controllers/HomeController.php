<?php

namespace App\Http\Controllers;

use App\Models\EditRequest;
use App\Models\Message;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $count_users=User::all()->count();
        $count_students=User::where('role_id',3)->get()->count();
        $users=User::orderBy('id', 'desc')->take(5)->get();
        $messages=Message::all()->count();
        return view('dashboard',compact('count_users','users','count_students','messages'));
    }
}
