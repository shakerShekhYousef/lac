<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'id'=>$this->id,
            'code'=>$this->code,
            'groupName'=>$this->groupName,
            'days'=>$this->days,
            'daysId'=>$this->daysId,
            'timeFrom'=>$this->timeFrom,
            'timeTo'=>$this->timeTo,
            'image'=>'/storage/images/groups'.$this->image,
            
        ];
    }
}
