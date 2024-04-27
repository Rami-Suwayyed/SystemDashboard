<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $setting = Setting::first();
        return [
            'id' => $this->id,
            'title'=> $this->title,
            'slug'=>$this->slug,
            'sub_menu'=>$this->slug != '/products' ?  $this->slug == '' ? UsefulLinkResource::collection($setting->useful_link) : '' : ProductResource::collection(Product::active()->get()),
        ];
    }
}
