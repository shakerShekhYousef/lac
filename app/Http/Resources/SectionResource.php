<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'name'=>$this->name,
            'name_ar'=>$this->name_ar,
            'translate'=>$this->translate,
            'translate_ar'=>$this->translate_ar,
            'conversation'=>$this->conversation,
            'conversation_ar'=>$this->conversation_ar,
            'image'=>'/storage/images/sections/'.$this->image
        ];
    }
}
