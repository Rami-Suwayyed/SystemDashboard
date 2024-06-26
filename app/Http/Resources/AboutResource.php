<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'show_home' => (boolean)$this->show_home,
            'type' => (boolean)$this->doctor_word,
            'image' => $this->image,
            'icon' => $this->icon,
            'sort' => $this->sort
        ];
    }
}
