<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'banner_type'       => $this->banner_type,
        ];
        
        $data['banner_images'] = [];

        $banner_img_arr = explode(',', $this->banner);

        foreach ($banner_img_arr as $banner_img){
            $data['banner_images'][] = asset('public/'.api_asset($banner_img));
        }

        return $data;
    }
}
