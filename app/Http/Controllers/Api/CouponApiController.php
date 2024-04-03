<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\VendorCoupon;
use App\Http\Resources\Api\CouponResource;

class CouponApiController extends Controller
{
    public function couponList()
    {
        return response([
            'success'=> true,
            'coupon_list' => CouponResource::collection(VendorCoupon::where('user_id', getVendor()->user_id)->orderBy('coupon_name', 'asc')->get())
        ],200);
    }

    public function applyCoupon(Request $request)
    {
        $this->validate($request, [
            'coupon_name'    => 'required',
        ]);
        $couponName = $request->coupon_name;
        $coupon = VendorCoupon::where('coupon_name', $couponName)->first();
        if($coupon){
            $totalAmount = 0;
            $cartsData = Cart::where('user_id', auth()->id())->with('product')->get();
            foreach($cartsData as $cart){
                $totalAmount+=$cart->product->selling_price*$cart->quantity;
            }
            if($coupon->minimum_order_amount && $totalAmount >= $coupon->minimum_order_amount){

                if($coupon->discount_type=="flat"){

                    $totalAmount=$coupon->discount;

                }elseif($coupon->discount_type=="%"){

                    $totalAmount= $totalAmount*$coupon->discount/100;

                }
            
            }elseif($coupon->minimum_order_amount == null){

                if($coupon->discount_type=="flat"){

                    $totalAmount=$coupon->discount;

                }elseif($coupon->discount_type=="%"){

                    $totalAmount= $totalAmount*$coupon->discount/100;

                }

            }else{

                return response([
                    'success'   => false,
                    'message'   => "The total order amount is not sufficient for this coupon.",
                ],400);

            }

            return response([
                'success'   => true,
                'amount'   => (float) $totalAmount,
            ],200);

        }else{

            return response([
                'success'   => false,
                'message'   => "Invalid Coupon.",
            ],400);

        }
    }
}
