<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class StudentRequest extends Model
{
    protected $fillable=[
        'type_procedure_id','reason','student','is_done'
    ];
    public function type(){
        return $this->belongsTo(ProcedureType::class,'type_procedure_id','id');
    }
    public function admin(){
        return $this->hasOne(User::class);
    }


}
