<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRequest extends Model
{
    protected $fillable=[
        'user_id','confirm'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
