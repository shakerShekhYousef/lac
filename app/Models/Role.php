<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable=[
      'name'
    ];
    public function users(){
        return $this->hasMany(User::class);
    }
    public function requests(){
        return $this->hasMany('App\Models\EditRequest');
    }
}
