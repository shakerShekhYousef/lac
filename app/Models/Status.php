<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable=[
        'name','name_ar',
    ];

    public function users(){
        return $this->hasMany('App\User');
    }
    public function edits(){
        return $this->hasMany('App\Models\EditRequest');
    }
}
