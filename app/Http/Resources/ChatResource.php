<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ChatResource extends JsonResource
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
            'id' => $this->id,
            'image' => '/storage/images/groups/' . $this->image,
            'code' =>$this->code,
            'groupName'=>$this->groupName,
            'days'=>$this->days,
            'daysId'=>$this->daysId,
            'timeFrom'=>$this->timeFrom,
            'timeTo'=>$this->timeTo,
            'status'=>$this->status,
            'teachers'=>$this->getTeachers($this->id),
        ];
    }

    private function getTeachers($id){

        $teachers=DB::table('users')->where('role_id',4)->whereIn('id',function ($query) use ($id){
            $query->from('user_groups')->select('user_id')->where('group_id',$id)->get();
        })->get();
        return $teachers;

    }
}
