<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'email'         => $this->email??"",
            'profile_photo' => $this->retailerUserDetails->photo?asset('public/uploads/retailer_photo/'.$this->retailerUserDetails->photo):"",
            'gender'        => $this->retailerUserDetails->gender??"",
            'city'          => $this->retailerUserDetails->City,
            'category'      => $this->retailerUserDetails->Category,
            'kyc_status'    => $this->retailerUserDetails->kyc_status,
            'kyc_details'   => null,
            'bank_detail'   => $this->retailerBankDetail,
        ];

        // if($this->retailerUserDetails->kyc_status != 0){
        //     $this->retailerUserKyc->shop_front_image = asset('public/uploads/retailer_kyc/'.$this->retailerUserKyc->shop_front_image);
        //     $this->retailerUserKyc->other_document_file = asset('public/uploads/retailer_kyc/'.$this->retailerUserKyc->other_document_file);
        //     $data['kyc_details'] = $this->retailerUserKyc;
        // }
        $data['kyc_details'] = null;
        return $data;
    }
}
