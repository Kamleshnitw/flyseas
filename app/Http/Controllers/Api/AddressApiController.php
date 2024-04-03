<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\RetailerAddress;
use App\Http\Controllers\Controller;

class AddressApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RetailerAddress::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return response([
            'address_list'   => $data
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'state'     => 'required',
            'city'      => 'required',
            'pincode'   => 'required',
            'address'   => 'required',
        ]);
        $data = new RetailerAddress;
        $data->user_id = auth()->id();
        $data->state = $request->state;
        $data->city = $request->city;
        $data->pincode = $request->pincode;
        $data->country = "India";
        $data->address = $request->address;
        $data->save();
        return response([
            'message'   => "Address Added Successfully",
            'address'   => $data
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'state'     => 'required',
            'city'      => 'required',
            'pincode'   => 'required',
            'address'   => 'required',
        ]);
        $data = RetailerAddress::find($id);
        $data->state = $request->state;
        $data->city = $request->city;
        $data->pincode = $request->pincode;
        $data->country = "India";
        $data->address = $request->address;
        $data->save();
        return response([
            'message'   => "Address Updated Successfully",
            'address'   => $data
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RetailerAddress::destroy($id);
        return response([
            'message'   => "Address Deleted Successfully",
        ],200);
    }
}
