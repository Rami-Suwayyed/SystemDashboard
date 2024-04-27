<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminClassesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'status' => $this->status,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'platforms' => $this->platforms()->get()->pluck('platform_id'),
        ];
    }
}
