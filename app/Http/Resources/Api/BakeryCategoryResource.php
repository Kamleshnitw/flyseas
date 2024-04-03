<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BakeryCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $data = [
            'id'                => $this->id,
            'name'              => $this->name,
            'thumbnail_image'   => asset('public/'.api_asset($this->thumbnail_image)),
            'banner_image'      => $this->banner_image!=0 ? asset('public/'.api_asset($this->banner_image)): "",
        ];
    }
}
