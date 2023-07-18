<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'code'=>$this->code,
            'national_number'=>$this->national_number,
            'status'=>$this->status,
            'role_id'=>$this->role_id,
            'image'=>'/storage/images/users/'.$this->image,

        ];
    }
}
