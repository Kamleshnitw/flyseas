<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderApiResource extends JsonResource
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
            'slider_type'       => $this->slider_type,
        ];
        
        $data['slider_images'] = [];

        $slider_img_arr = explode(',', $this->slider);

        foreach ($slider_img_arr as $slider_img){
            $data['slider_images'][] = asset('public/'.api_asset($slider_img));
        }

        return $data;
    }
}
