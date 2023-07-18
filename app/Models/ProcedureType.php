<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentRequest;

class ProcedureType extends Model
{
    protected $fillable=[
        'name','name_ar'
    ];
    public function requests(){
        return $this->hasMany(StudentRequest::class);
    }
}
