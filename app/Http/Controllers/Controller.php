<?php

namespace App\Http\Controllers;

use App\Models\ChatRequest;
use App\Models\EditRequest;
use App\Models\StudentRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::user()->id;
            $admin_requests=StudentRequest::where('forward_to',$this->id)->where('is_done',0)->count();
            View::share('admin_requests',$admin_requests);
            return $next($request);
        });
        $requests=EditRequest::all();
        $count=count($requests);
        $password_requests=DB::table('edit_requests')->whereNotNull('password')->get();
        $p_count=count($password_requests);
        $users=$user = DB::table('users')->where('groups_request', 1)->distinct()->get();
        $g_count=count($users);
        $student_requests=StudentRequest::where('forward_to',null)->get()->count();
        $chatRequests=ChatRequest::where('confirm',0)->get()->count();
        $total=$g_count + $p_count + $count;
        View::share('edit_count',$count);
        View::share('password_count',$p_count);
        View::share('group_count',$g_count);
        View::share('total',$total);
        View::share('student_requests',$student_requests);
        View::share('chatRequestsCount',$chatRequests);

    }
}
