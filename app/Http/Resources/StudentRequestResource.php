<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'student' => $this->student,
            'reason' => $this->reason,
            'forward_to'=>$this->forward_to,
            'type'=>$this->type,
            'created_at'=>$this->created_at,
        ];
    }
}
