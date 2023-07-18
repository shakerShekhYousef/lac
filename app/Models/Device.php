<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'user_id', 'firebase_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
