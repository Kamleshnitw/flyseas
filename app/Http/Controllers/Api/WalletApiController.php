<?php

namespace App\Http\Controllers\Api;

use App\Models\Retailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RetailerWalletHistory;

class WalletApiController extends Controller
{
    public function wallet()
    {
        $amount = auth()->user()->retailerUserDetails->wallet_balance;
        $walletHistory=RetailerWalletHistory::where('user_id', auth()->id())->get();
        foreach($walletHistory as $data){
            $data->date = date('d-M-Y h:i A', strtotime($data->created_at));
        }
        return response([
            'success'           => true,
            'amount'            => $amount,
            'wallet_history'    => $walletHistory
        ],200);
    }

    public function walletRecharge(Request $request)
    {
        $this->validate($request, [
            'amount'    => 'required|numeric|min:1'
        ]);
        
        $merchantTransaction = date('Ymd-His') . rand(10, 99); 

        $data =  $this->payload_creation($request->amount, auth()->user()->phone, $merchantTransaction, auth()->id());

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

    public function payload_creation($amount, $phone, $merchantTransaction, $user_id)
    {
        $payload = array(
            "merchantId" => env('PHONEPE_MERCHANT_ID'),
            "merchantTransactionId" => $merchantTransaction,
            "merchantUserId" => "MUID" . rand(1111, 9999),
            "amount" => $amount * 100,
            "redirectUrl" => "https://flyseas.in/admin/api/phonepe/walletRedirectUrl?merchant_transaction_id=".$merchantTransaction."&user_id=".$user_id,
            "redirectMode" => "POST",
            "callbackUrl" => "https://flyseas.in/admin/api/phonepe/walletRcallbackUrl?merchant_transaction_id=".$merchantTransaction."&user_id=".$user_id,
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
            $response_amount = $response_data->data->amount / 100;
            $retailer = Retailer::where('user_id', $request->user_id)->first();
            $retailer->wallet_balance = $retailer->wallet_balance+$response_amount;
            $retailer->save();

            $history = new RetailerWalletHistory;
            $history->user_id = $request->user_id;
            $history->type = "credit";
            $history->amount = $response_amount;
            $history->payment_details = json_encode($data);
            $history->save();

            
        }else{

            $history = new RetailerWalletHistory;
            $history->user_id = $request->user_id;
            $history->type = "failed";
            $history->amount = $response_amount;
            $history->payment_details = json_encode($data);
            $history->save();

        }
        return $response_data;
    }

    public function redirectUrl(Request $request)
    {
        $data = $this->status_check_api($request->merchant_transaction_id);
        $response_data = json_decode($data);
        if ($response_data->success == true) {
            $response_amount = $response_data->data->amount / 100;
            $retailer = Retailer::where('user_id', $request->user_id)->first();
            $retailer->wallet_balance = $retailer->wallet_balance+$response_amount;
            $retailer->save();

            $history = new RetailerWalletHistory;
            $history->user_id = $request->user_id;
            $history->type = "credit";
            $history->amount = $response_amount;
            $history->payment_details = json_encode($data);
            $history->save();

            
        }else{

            $history = new RetailerWalletHistory;
            $history->user_id = $request->user_id;
            $history->type = "failed";
            $history->amount = $response_data->data->amount / 100;
            $history->payment_details = json_encode($data);
            $history->save();

        }
        return response()->json([
            'success'           => $response_data->success,
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
