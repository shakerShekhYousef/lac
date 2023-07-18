<?php

namespace App;

use App\Models\Status;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','code','national_number','status_id','role_id','has_changes'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Role relation
    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
    // Request relation
    public function request(){
        return $this->hasOne('App\Models\EditRequest');
    }
    public function studentRequest(){
        return $this->belongsTo('App\Models\StudentRequest');
    }
    public function groups(){
        return $this->hasMany('App\Models\user_groups');
    }
    public function groupRequests(){
        return $this->hasMany('App\Models\GroupRequest');
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
    public function devices(){
        return $this->hasMany(Device::class);
    }
    public function chatRequests(){
        return $this->hasMany('App\Models\ChatRequest');
    }

// Functions to check roles
    public function hasRole($role){
        if ($this->role()->where('name',$role)->first()){
            return true;
        }
        return false;
    }
    public function hasAnyRole($roles){
        if (is_array($roles)){
            foreach ($roles as $role){
                if ($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if ($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }
}
