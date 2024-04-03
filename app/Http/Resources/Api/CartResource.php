<?php

namespace App\Http\Resources\Api;

use App\Models\Admin\Bakery\BakeryProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        
        $data = [
            'id'                => $this->id,
            'product_id'        => $this->product_id,
            'quantity'          => $this->quantity,
            'product_name'      => $this->product->product_name,
            'combination_name'  => $this->combination_name,
        ];
        $data['gst'] = BakeryProduct::find($this->product->bakery_product_id)->gst;
        $getKey=array_search($this->combination_name, $this->product->combination_name);
        
        $data['thumbnail'] = asset('public/'.api_asset($this->product->thumbnail[$getKey]));
        $data['purchase_price'] = $this->product->purchase_price[$getKey];
        $data['selling_price'] = $this->product->selling_price[$getKey];
        $data['mrp_price'] = $this->product->mrp_price[$getKey];
        $data['discount_price'] = $this->product->discount_price[$getKey];
        $data['discount_type'] = $this->product->discount_type[$getKey];
        return $data;
    }
}
