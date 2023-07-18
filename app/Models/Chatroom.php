<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    protected $fillable=[
        'id','groupName','code','level','time','days','daysId'
    ];

    public function groups(){
        return $this->hasMany('App\Models\user_groups');
    }
    public function groupRequests(){
        return $this->hasMany('App\Models\GroupRequest');
    }

}
