<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupRequest extends Model
{
    protected $fillable=[
      'user_id','group_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function group(){
        return $this->belongsTo('App\Models\Chatroom','group_id','id');
    }
}
