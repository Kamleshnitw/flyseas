<?php

namespace App\Http\Controllers\Api;

use App\Models\RetailerKyc;
use Illuminate\Http\Request;
use App\Models\RetailerAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RetailerKycRequest;

class KycApiController extends Controller
{
    public function kycStore(RetailerKycRequest $request)
    {
        $kyc_data = RetailerKyc::where('user_id', auth()->id())->first();
        if(!$kyc_data){
            $kyc_data = new RetailerKyc;
            $address = new RetailerAddress;
            $address->user_id = auth()->id();
            $address->state = $request->state;
            $address->city = $request->city;
            $address->pincode = $request->pincode;
            $address->country = "India";
            $address->address = $request->shop_full_address;
            $address->save();
        }
        $kyc_data->user_id = auth()->id();
        $kyc_data->shop_name = $request->shop_name;
        $shop_front_image = time().rand(10,100).'.'.$request->shop_front_image->extension();
        $request->shop_front_image->move(public_path('uploads/retailer_kyc'), $shop_front_image);
        $kyc_data->shop_front_image = $shop_front_image;
        $kyc_data->shop_full_address = $request->shop_full_address;
        $kyc_data->owner_name = $request->owner_name;
        $kyc_data->other_document = $request->other_document;
        $other_document_file = time().rand(10,100).'.'.$request->other_document_file->extension();
        $request->other_document_file->move(public_path('uploads/retailer_kyc'), $other_document_file);
        $kyc_data->other_document_file = $other_document_file;
        $kyc_data->save();

        auth()->user()->retailerUserDetails->kyc_status = 1;
        auth()->user()->retailerUserDetails->save();
        return response([
            'success'   => true,
            'message'   => "KYC Update Successfully",
        ],200);

    }
}
