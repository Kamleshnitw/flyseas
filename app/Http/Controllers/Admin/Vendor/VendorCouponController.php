<?php

namespace App\Http\Controllers\Admin\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\VendorCoupon;

class VendorCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=VendorCoupon::where('user_id', auth()->id())->orderBy('coupon_name', 'asc');
        $search=$request->key;
        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('vendor.coupon.index',['key='.$search.'&page='.$page])->with('error', 'Data Deleted');
        }

        return view('backend.vendor.coupon.index',compact('list','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $key=$request->key;
        $page=$request->page;
        return view('backend.vendor.coupon.create',compact('key', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key=$request->key;
        $page=$request->page;
        $data = new VendorCoupon;
        $data->user_id = auth()->id();
        $data->banner = $request->banner;
        $data->coupon_name = $request->coupon_name;
        $data->uses_type = $request->uses_type;
        $data->discount = $request->discount;
        $data->discount_type = $request->discount_type;
        $data->minimum_order_amount = $request->minimum_order_amount;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->short_description = $request->short_description;
        $data->terms_conditions = $request->terms_conditions;
        $data->save();
        return redirect()->route('vendor.coupon.index',['key='.$key.'&page='.$page])->with('success','Coupon has been created successfully !');

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
        $edit_data = VendorCoupon::find($id);
        return view('backend.vendor.coupon.edit', compact('key', 'page', 'edit_data'));
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
        $data = VendorCoupon::find($id);
        $data->user_id = auth()->id();
        $data->banner = $request->banner;
        $data->coupon_name = $request->coupon_name;
        $data->uses_type = $request->uses_type;
        $data->discount = $request->discount;
        $data->discount_type = $request->discount_type;
        $data->minimum_order_amount = $request->minimum_order_amount;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->short_description = $request->short_description;
        $data->terms_conditions = $request->terms_conditions;
        $data->save();
        return redirect()->route('vendor.coupon.index',['key='.$key.'&page='.$page])->with('success','Coupon has been updated successfully !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $key=$request->key;
        $page=$request->page;
        VendorCoupon::find($id)->delete();
        return redirect()->route('vendor.coupon.index',['key='.$key.'&page='.$page])->with('error','Coupon Deleted!');
    }
}
