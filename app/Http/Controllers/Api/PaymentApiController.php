<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentApiController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $order = new Order;
        $order->user_id = auth()->id();
        $order->city_id = auth()->user()->retailerUserDetails->City->id;
        $order->address_id = $request->address_id;
        $order->order_id = "FLS-".time();
        $order->product_details = $request->product_details;
        $order->total_amount = $request->total_amount;
        $order->coupon_code = $request->coupon_code;
        $order->coupon_discount = $request->coupon_discount;
        $order->grand_amount = $request->grand_amount;
        $order->user_name = auth()->user()->name;
        $order->user_phone = auth()->user()->phone;
        $order->user_address = $request->user_address;
        $order->payment_type = $request->payment_type;
        $order->payment_status = $request->payment_status;
        $order->order_history = [['order_status' => 'Pending', 'time' => date('Y-m-d H:i:s')]];
        $order->save();
        $cartsDatas = Cart::where('user_id', auth()->id())->delete();

        $merchantTransaction = date('Ymd-His') . rand(10, 99); 

        $data =  $this->payload_creation($request->grand_amount, auth()->user()->phone, $merchantTransaction, $order->id);

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode(['request' => $data['payload']]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY:" . $data['base_hash'],
            "accept: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {

            $payment_response = json_decode($response)->data;
            return response()->json([
                'url'   => $payment_response->instrumentResponse->redirectInfo->url
            ], 200);
        }
    }

    public function payload_creation($amount, $phone, $merchantTransaction, $order_id)
    {
        $payload = array(
            "merchantId" => env('PHONEPE_MERCHANT_ID'),
            "merchantTransactionId" => $merchantTransaction,
            "merchantUserId" => "MUID" . rand(1111, 9999),
            "amount" => $amount * 100,
            "redirectUrl" => "https://flyseas.in/admin/api/phonepe/redirectUrl?merchant_transaction_id=".$merchantTransaction."&order_id=".$order_id,
            "redirectMode" => "POST",
            "callbackUrl" => "https://flyseas.in/admin/api/phonepe/callbackUrl?merchant_transaction_id=".$merchantTransaction."&order_id=".$order_id,
            "mobileNumber" => $phone,
            "paymentInstrument" => ["type" => "PAY_PAGE"],
        );

        $payload_json = json_encode($payload);
        $base64_payload = base64_encode($payload_json);

        $salt = env('PHONEPE_SALT'); // replace with your actual salt key

        $hash_input = $base64_payload . "/pg/v1/pay" . $salt;

        $sha256_hash = hash('sha256', $hash_input) . '###1';
        return ['payload' => $base64_payload, 'base_hash' => $sha256_hash];
    }

    public function callback(Request $request)
    {
        $data = base64_decode($request);
        $response_data = json_decode($data);
        if ($response_data->success == true) {
            $orderData = Order::find($request->order_id);
            $orderData->payment_status = 'Paid';
            $orderData->payment_details = json_encode($data);
            $orderData->save();
        }else{
            $orderData = Order::find($request->order_id);
            $orderData->payment_status = 'Failed';
            $orderData->payment_details = json_encode($data);
            $orderData->save();
        }
        return $response_data;
    }

    public function redirectUrl(Request $request)
    {
        $data = $this->status_check_api($request->merchant_transaction_id);
        $response_data = json_decode($data);
        if ($response_data->success == true) {
            $orderData = Order::find($request->order_id);
            $orderData->payment_status = 'Paid';
            $orderData->payment_details = json_encode($response_data);
            $orderData->save();
        }else{
            $orderData = Order::find($request->order_id);
            $orderData->payment_status = 'Failed';
            $orderData->payment_details = json_encode($data);
            $orderData->save();
        }
        return response()->json([
            'success'           => $response_data->success,
            'order_id'          => $orderData->order_id,
            'transaction_id'    => $response_data->data->transactionId
        ], 200);

    }

    public function payload_creation_status_check($merchant_transaction_id)
    {

        $salt = env('PHONEPE_SALT'); // replace with your actual salt key

        $hash_input = "/pg/v1/status/M10OHIF4HWOU/" . $merchant_transaction_id . $salt;

        $sha256_hash = hash('sha256', $hash_input) . '###1';
        return $sha256_hash;
    }

    public function status_check_api($merchant_transaction_id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/status/M10OHIF4HWOU/" . $merchant_transaction_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-MERCHANT-ID: M10OHIF4HWOU",
            "X-VERIFY: " . $this->payload_creation_status_check($merchant_transaction_id),
            "accept: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
