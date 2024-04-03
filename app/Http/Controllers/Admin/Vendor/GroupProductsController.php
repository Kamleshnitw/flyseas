<?php

namespace App\Http\Controllers\Admin\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\GroupProduct;
use App\Models\Admin\Vendor\VendorProduct;

class GroupProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=GroupProduct::where('user_id', auth()->id());
        $search=$request->key;
        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('vendor.group-product.index',['key='.$search.'&page='.$page])->with('error', 'Vendor Product Deleted');
        }

        return view('backend.vendor.group_product.index',compact('list','search'));
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
        $productLists=VendorProduct::where('user_id', auth()->id())->orderBy('product_name','asc')->get();
        return view('backend.vendor.group_product.create',compact('key', 'page', 'productLists'));
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
        $data = new GroupProduct;
        $data->user_id = auth()->id();
        $data->group_name = $request->group_name;
        $data->product_id = $request->product_id;
        $data->save();
        return redirect()->route('vendor.group-product.index',['key='.$key.'&page='.$page])->with('success','Group Product has been created successfully !');
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
        $edit_data = GroupProduct::find($id);
        $productLists=VendorProduct::where('user_id', auth()->id())->orderBy('product_name','asc')->get();
        return view('backend.vendor.group_product.edit', compact('key', 'page', 'edit_data', 'productLists'));
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
        $data = GroupProduct::find($id);
        $data->user_id = auth()->id();
        $data->group_name = $request->group_name;
        $data->product_id = $request->product_id;
        $data->save();
        return redirect()->route('vendor.group-product.index',['key='.$key.'&page='.$page])->with('success','Group Product has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        $data = GroupProduct::find($id)->delete();
        return redirect()->route('vendor.group-product.index',['key='.$key.'&page='.$page])->with('error','Group Deleted!');

    }
}
