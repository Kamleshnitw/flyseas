<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Models\Retailer;
use App\Models\RetailerKyc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RetailerKycController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->user_type=="super_admin" || auth()->user()->user_type=="admin"){
            $list = Retailer::orderBy('id', 'desc')->whereIn('kyc_status', [1, 3]);
        }else{
            $list = Retailer::orderBy('id', 'desc')->where('city_id', auth()->user()->userDetails->city_id)->whereIn('kyc_status', [1, 3]);
        }
        $search=$request->key;
        $page=$request->page;
        $list=$list->with(['user', 'retailerKyc'])->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('vendor.retailer-kyc.index',['key='.$search.'&page='.$page])->with('error', 'No Data Found');
        }

        return view('backend.vendor.retailerkyc.index',compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $key=$request->key;
        $page=$request->page;
        $edit_data = Retailer::find($id);
        return view('backend.vendor.retailerkyc.status_update', compact('key', 'page', 'edit_data'));
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
        $key=$request->key;
        $page=$request->page;
        $data = Retailer::find($id);
        $data->kyc_status = $request->kyc_status;
        $data->kyc_remarks = $request->kyc_remarks;
        $data->save();
        return redirect()->route('vendor.retailer-kyc.index',['key='.$key.'&page='.$page])->with('success','Kyc Status updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
