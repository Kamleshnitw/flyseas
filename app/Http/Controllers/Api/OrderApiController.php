<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Retailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RetailerWalletHistory;

class OrderApiController extends Controller
{
    public function orderStore(Request $request)
    {
        $retailer = Retailer::where('user_id', auth()->id())->first();
        if($retailer->wallet_balance >= 0){
            $data = new Order;
            $data->user_id = auth()->id();
            $data->city_id = auth()->user()->retailerUserDetails->City->id;
            $data->address_id = $request->address_id;
            $data->order_id = "FLS-".time();
            $data->product_details = $request->product_details;
            $data->total_amount = $request->total_amount;
            $data->coupon_code = $request->coupon_code;
            $data->coupon_discount = $request->coupon_discount;
            $data->grand_amount = $request->grand_amount;
            $data->user_name = auth()->user()->name;
            $data->user_phone = auth()->user()->phone;
            $data->user_address = $request->user_address;
            $data->payment_type = $request->payment_type;
            $data->payment_status = $request->payment_status;
            $data->order_history = [['order_status' => 'Pending', 'time' => date('Y-m-d H:i:s')]];
            $data->save();
            $cartsDatas = Cart::where('user_id', auth()->id())->delete();

            $retailer->wallet_balance = $retailer->wallet_balance-$request->grand_amount;
            $retailer->save();
            
            $history = new RetailerWalletHistory;
            $history->user_id = auth()->id();
            $history->order_id = $data->id;
            $history->type = "debit";
            $history->amount = $request->grand_amount;
            $history->save();
            
            return response([
                'success'   => true,
                'order_id'  => $data->order_id,
                'message'   => "Order Placed Successfully.",
            ],200);

        }else{

            return response([
                'success'   => false,
                'message'   => "You have due amount.",
            ],400);
        }
        
    }

    public function orderList()
    {
        $data = Order::select('order_id', 'product_details', 'total_amount', 'order_status', 'payment_status', 'grand_amount', 'created_at')->where('user_id', auth()->id())->get();
        foreach($data as $list){
            $list->product_count = count(json_decode($list->product_details));
            $list->order_time = date('d M Y H:i A', strtotime($list->created_at));
        }
        return response([
            'success'       => true,
            'order_list'    => $data,
        ],200);
    }

    public function orderDetail($order_id)
    {
        $data = Order::select('order_id', 'product_details', 'total_amount', 'order_status', 'payment_status', 'order_history', 'grand_amount', 'created_at')->where('order_id', $order_id)->first();
        $data->order_time = date('d M Y H:i A', strtotime($data->created_at));
        $data->product_list = json_decode($data->product_details);
        $data->invoice = route('order-invoice', $data->order_id);
        return response([
            'success'       => true,
            'order_detail'    => $data,
        ],200);
    }


}
