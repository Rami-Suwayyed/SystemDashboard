<?php

namespace App\Http\Resources;

use App\Models\Languages;
use App\Models\SocialMedia;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'site_name' => $this->site_name,
            'phone_number' => $this->phone_number,
            'country' => $this->country ?? 'Jordan',
            'email' => $this->email,
            'main_color' => $this->main_color,
            'secondary_color' => $this->secondary_color,
            'fav_icon' => $this->fav_icon,
            'footer_icon' => $this->footer_icon,
            'header_icon' => $this->header_icon,
            'useful_link' => UsefulLinkResource::collection($this->useful_link),
            'languages' => LanguageResource::collection(Languages::where('status', '=', 1)->get()),
            'social_media' => SocialMediaResource::collection(SocialMedia::where('status', '=', 1)->orderBy('sort', 'asc')->get()),
        ];
    }
}
