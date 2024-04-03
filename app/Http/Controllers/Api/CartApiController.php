<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CartResource;
use App\Models\Admin\Vendor\VendorProduct;

class CartApiController extends Controller
{

    public function cartList()
    {
        return response([
            'success'     => true,
            'cart_list'   => CartResource::collection(Cart::where('user_id', auth()->id())->with('product')->get()),
        ],200);

    }

    public function addToCart(Request $request)
    {
        $this->validate($request, [
            'product_id'        => 'required',
            'quantity'          => 'required',
            'combination_name'  => 'required',
        ]);

        $data = new Cart;
        $data->user_id = auth()->id();
        $data->product_id = $request->product_id;
        $data->quantity = $request->quantity;
        $data->combination_name = $request->combination_name;
        $data->save();
        return response([
            'success'   => true,
            'message'   => "Product added in cart successfully.",
        ],200);
    }

    public function updatedQuantity(Request $request)
    {
        $this->validate($request, [
            'product_id'        => 'required',
            'quantity'          => 'required',
            'combination_name'  => 'required',
        ]);

        $data = Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->where('combination_name', $request->combination_name)->first();
        if($data){
            $checkProductQuantity = VendorProduct::find($request->product_id)->quantity;
            if($request->quantity<=$checkProductQuantity){
                $data->quantity = $request->quantity;
                $data->save();
                return response([
                    'success'   => true,
                    'message'   => "Product quantity update successfully.",
                ],200);
                
            }else{

                return response([
                    'success'   => false,
                    'message'   => "Product quantity exceeded.",
                ],400);

            }
        }
        return response([
            'success'   => false,
            'message'   => "Product not found in cart.",
        ],400);
    }

    public function removeCartProduct(Request $request)
    {
        $this->validate($request, [
            'product_id'        => 'required',
            'combination_name'  => 'required',
        ]);
        $data = Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->where('combination_name', $request->combination_name)->first();
        if($data){
            $data->delete();
            return response([
                'success'   => true,
                'message'   => "Product remove from cart.",
            ],200);
        }
        return response([
            'success'   => false,
            'message'   => "Product not found in cart.",
        ],400);
    }
}
