<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'password','image','code','national_number','status_id','role_id','user_id'
    ];
    public function user(){
       return $this->belongsTo('App\User');
    }
    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
    public function status(){
        return $this->belongsTo('App\Models\Status','status_id','id');
    }


}
