<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        $data = [
            'name'          => $this->name,
            'phone'         => $this->phone,
            'city'          => $this->retailerUserDetails ? $this->retailerUserDetails->City : null,
            'category'      => $this->retailerUserDetails ? $this->retailerUserDetails->Category : null,
            'kyc_status'    => 2,

        ];

        return $data;
    }
}
