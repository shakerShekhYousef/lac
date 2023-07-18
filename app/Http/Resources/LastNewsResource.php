<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LastNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'title_ar' => $this->title_ar,
            'body' => $this->body,
            'body_ar' => $this->body_ar,
            'image'=>'/storage/images/posts/'.$this->image,
            'created_at'=>$this->created_at,
        ];
    }
}
