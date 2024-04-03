<?php

namespace App\Http\Controllers\Admin\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\VendorOffer;
use App\Models\Admin\Vendor\VendorProduct;
use App\Models\Admin\Bakery\BakeryCategory;


class VendorOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=VendorOffer::where('user_id', auth()->id());
        $search=$request->key;
        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('vendor.offer.index',['key='.$search.'&page='.$page])->with('error', 'Vendor Product Deleted');
        }

        return view('backend.vendor.offer.index',compact('list','search'));
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
        return view('backend.vendor.offer.create',compact('key', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->product_id != null){
            $data = new VendorOffer;
            $data->user_id = auth()->id();
            $data->banner = $request->banner;
            $data->category_id = $request->category_id;
            $data->product_id = $request->product_id;
            $data->type = $request->type;
            $data->last_date = $request->last_date;
            $data->for_user = $request->for_user;
            $data->discount = $request->discount;
            $data->discount_type = $request->discount_type;
            $data->minimum_value = $request->minimum_value;
            $data->minimum_value_type = $request->minimum_value_type;
            $data->save();
            return redirect()->route('vendor.offer.index')->with('success','Offer has been Added successfully');
        }
        return redirect()->back()->with('error', 'There was an error!!');
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
        $edit_data = VendorOffer::find($id);
        return view('backend.vendor.offer.edit', compact('key', 'page', 'edit_data'));
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

        if($request->product_id != null){
            $data = VendorOffer::find($id);
            $data->user_id = auth()->id();
            $data->banner = $request->banner;
            $data->category_id = $request->category_id;
            $data->product_id = $request->product_id;
            $data->type = $request->type;
            $data->last_date = $request->last_date;
            $data->for_user = $request->for_user;
            $data->discount = $request->discount;
            $data->discount_type = $request->discount_type;
            $data->minimum_value = $request->minimum_value;
            $data->minimum_value_type = $request->minimum_value_type;
            $data->save();
            return redirect()->route('vendor.offer.index',['key='.$key.'&page='.$page])->with('success','Offer has been updated successfully');
        }
        return redirect()->back()->with('error', 'There was an error!!');
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
        VendorOffer::find($id)->delete();
        return redirect()->route('vendor.offer.index',['key='.$key.'&page='.$page])->with('error','Offers Deleted!');
    }

    public function getCategory()
    {
        return BakeryCategory::orderBy('name','asc')->get();
    }

    public function getProductbyCategory(Request $request)
    {
        $offer_type = $request->offer_type;
        $edit_data_id = $request->edit_data_id;
        if($offer_type=="category"){

            $products = VendorProduct::where('user_id', auth()->id())->whereIn('category_id', explode(',', $request->category_id))->orderBy('product_name','asc')->get();

        }else if($offer_type=="product"){
            
            $products = VendorProduct::where('user_id', auth()->id())->orderBy('product_name','asc')->get();
    
        }
        return view('backend.vendor.offer.product_list', compact('products', 'offer_type', 'edit_data_id'))->render();
    }
}
