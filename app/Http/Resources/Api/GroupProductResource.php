<?php

namespace App\Http\Resources\Api;

use App\Models\Admin\Vendor\VendorProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupProductResource extends JsonResource
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
            'group_name'    => $this->group_name,
            'products'      => [],
        ];
        foreach ($this->product_id as $product_id){
            $data['products'][]=new ProductResource(VendorProduct::find($product_id));
        }
        return $data;
    }
}
