<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'id'            => $this->id,
            'banner'        => asset('public/'.api_asset($this->banner)),
            'coupon_name'   => $this->coupon_name,
            'uses_type'     => $this->uses_type,
            'discount_type' => $this->discount_type,
            'discount'      => $this->discount,
            'minimum_order_amount'  => $this->minimum_order_amount,
            'start_date'    => $this->start_date,
            'end_date'      => $this->end_date,
            'short_description' => $this->short_description,
            'terms_conditions'  => $this->terms_conditions
        ];

        return $data;
    }
}
