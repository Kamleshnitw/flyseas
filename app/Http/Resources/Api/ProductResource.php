<?php

namespace App\Http\Resources\Api;

use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id'       => $this->category_id,
            'sub_category_id'   => $this->sub_category_id,
            'product_name'      => $this->product_name,
            // 'thumbnail'         => asset('public/'.api_asset($this->thumbnail)),
            // 'description'       => $this->description,
            // 'purchase_price'    => $this->purchase_price,
            // 'selling_price'     => $this->selling_price,
            // 'mrp_price'         => $this->mrp_price,
            // 'discount_price'    => $this->discount_price,
            // 'discount_type'     => $this->discount_type,
            // 'in_cart'           => false,
            // 'quantity'          => 0,
        ];

        // $checkCart = Cart::where('user_id', auth()->id())->where('product_id', $this->id)->first();

        // if($checkCart){
        //     $data['in_cart'] = true;
        //     $data['quantity'] = $checkCart->quantity;
        // }


        $variationArr = [];
       
        foreach ($this->variation_name as $variationKey => $variation_name) {
            $variation['variation_name'] = $variation_name;
            $variationData=[];
            foreach ($this->variation_value as $variation_value) {
                $variationData[] = json_decode($variation_value)[$variationKey];
            }
            $variation['variation_value'] = array_unique($variationData);
            $variationArr[] = $variation;
        }
        $data['attributes']=$variationArr;

        $variationCombinationArr = [];
        foreach($this->combination_name as $combinationKey => $combination_name){
            $variationCombination['combination_name'] = $combination_name;
            $variationCombination['thumbnail'] = asset('public/'.api_asset($this->thumbnail[$combinationKey]));
            $variationCombination['gallery'] = mult_api_asset($this->gallery[$combinationKey]);
            $variationCombination['tax'] = $this->tax[$combinationKey];
            $variationCombination['hsn_code'] = $this->hsn_code[$combinationKey];
            $variationCombination['description'] = $this->description[$combinationKey];
            $variationCombination['purchase_price'] = $this->purchase_price[$combinationKey];
            $variationCombination['selling_price'] = $this->selling_price[$combinationKey];
            $variationCombination['mrp_price'] = $this->mrp_price[$combinationKey];
            $variationCombination['discount_price'] = $this->discount_price[$combinationKey];
            $variationCombination['discount_type'] = $this->discount_type[$combinationKey];
            $variationCombination['sku_code'] = $this->sku_code[$combinationKey];
            $variationCombination['quantity'] = $this->quantity[$combinationKey];

            $checkCart = Cart::where('user_id', auth()->id())->where('product_id', $this->id)->where('combination_name', $combination_name)->first();

            if($checkCart){
                $variationCombination['in_cart'] = true;
                $variationCombination['cart_quantity'] = $checkCart->quantity;
            } else {
                $variationCombination['in_cart'] = false;
                $variationCombination['cart_quantity'] = 0;
            }

            $variationCombinationArr[]=$variationCombination;
        }

        $data['variation'] = $variationCombinationArr;

        return $data;
    }
}
