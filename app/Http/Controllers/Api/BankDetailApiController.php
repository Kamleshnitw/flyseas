<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RetailerBankDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProfileResource;

class BankDetailApiController extends Controller
{
    public function bankDetailStore(Request $request)
    {
        $this->validate($request, [
            'account_holder_name'     => 'required',
            'account_number'          => 'required',
            'bank_name'               => 'required',
            'ifsc_code'               => 'required',
            'address'                 => 'required',
        ]);

        $data = new RetailerBankDetail;
        $data->user_id = auth()->id();
        $data->account_holder_name = $request->account_holder_name;
        $data->account_number = $request->account_number;
        $data->bank_name = $request->bank_name;
        $data->ifsc_code = $request->ifsc_code;
        $data->address = $request->address;
        $data->save();

        return response([
            'success'     => true,
            'profile'     => 'Bank Details Added Successfully',
        ],200);

    }

    public function bankDetailUpdate(Request $request)
    {
        $this->validate($request, [
            'account_holder_name'     => 'required',
            'account_number'          => 'required',
            'bank_name'               => 'required',
            'ifsc_code'               => 'required',
            'address'                 => 'required',
        ]);

        $data = RetailerBankDetail::where('user_id', auth()->id())->first();
        $data->account_holder_name = $request->account_holder_name;
        $data->account_number = $request->account_number;
        $data->bank_name = $request->bank_name;
        $data->ifsc_code = $request->ifsc_code;
        $data->address = $request->address;
        $data->save();

        return response([
            'success'     => true,
            'profile'     => 'Bank Details Updated Successfully',
        ],200);
    }
}
