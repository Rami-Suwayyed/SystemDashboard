<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $count=0;
        foreach ($this->LoginLog as $Log){
            $count = $count + $Log->count;
        }
        return [
            'id' => $this->id,
            'date'=> $this->created_at->format('Y-m-d'),
            'name' => $this->name,
            'email' => $this->email,
            'school' =>$this->school ?$this->school->name : '' ,
            'class' => $this->class ?  $this->class->name : '',
            'type' => $this->Role ? $this->Role->name : '',
            'count_login_log' => $count,
            'readers_count' => $this->books_history_log_count ? $this->books_history_log_count :'',
        ];
    }
}
