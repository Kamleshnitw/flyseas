<?php

namespace App\Http\Controllers\Admin\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Bakery\BakeryProduct;
use App\Models\Admin\Vendor\VendorProduct;
use App\Models\Admin\Vendor\CheckVendorProductList;

class VendorProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vendor-product-index', ['only' => ['index']]);
        $this->middleware('permission:vendor-product-create', ['only' => ['create','store']]);
        $this->middleware('permission:vendor-product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:vendor-product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=VendorProduct::where('user_id', auth()->id())->orderBy('product_name','asc');
        $search=$request->key;
        if(!empty($search))
        {
            $list=$list->where('product_name','like','%'.$search.'%');
        }

        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('vendor.products.index',['key='.$search.'&page='.$page])->with('error', 'Vendor Product Deleted');
        }

        return view('backend.vendor.product.index',compact('list','search'));
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
        $bakeryProductList=BakeryProduct::orderBy('product_name','asc')->with('bakeryVariation')->paginate(25);
        if($request->ajax()){
            return view('backend.vendor.product.brakery_product_list', compact('bakeryProductList'));
        }
        return view('backend.vendor.product.create',compact('key', 'page', 'bakeryProductList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        if(isset($request->bakery_product_id)){
            foreach(array_unique($request->bakery_product_id) as $key => $bakery_product_id){
                $check = CheckVendorProductList::where('user_id', auth()->id())->where('product_id', $bakery_product_id)->delete();
                $bakery_product = BakeryProduct::find($bakery_product_id);
                $attribute_id = [];
                $variation_name = [];
                foreach($bakery_product->variation_data as $variation_data){
                    $attribute_id[] = $variation_data['id'];
                    $variation_name[] = $variation_data['name'];
                }
                $data = VendorProduct::where('bakery_product_id', $bakery_product_id)->first();
                if($data){

                    $data->user_id = auth()->id();
                    $data->bakery_product_id = $bakery_product_id;
                    $data->category_id = $bakery_product->category_id;
                    $data->sub_category_id = $bakery_product->sub_category_id;
                    $data->attribute_id = $attribute_id;
                    $data->variation_name = $variation_name;
                    
                    $variation_value = $data->variation_value;
                    foreach($request->variation_value as $req_variation_value){
                        $variation_value[]= $req_variation_value;
                    }
                    $data->variation_value = $variation_value;
                
                    $combination_name = $data->combination_name;
                    foreach ($request->combination_name as $req_combination_name) {
                        $combination_name[]=$req_combination_name;
                    }
                    $data->combination_name = $combination_name;
                    
                    $thumbnail = $data->thumbnail;
                    foreach ($request->thumbnail as $req_thumbnail) {
                        $thumbnail[] = $req_thumbnail;
                    } 
                    $data->thumbnail = $thumbnail;

                    $gallery = $data->gallery;
                    foreach ($request->gallery as $req_gallery){
                        $gallery[] = $req_gallery;
                    }
                    $data->gallery = $gallery;

                    $tax = $data->tax;
                    foreach ($request->tax as $req_tax){
                        $tax[] = $req_tax;
                    }
                    $data->tax = $tax;

                    $hsn_code = $data->hsn_code;
                    foreach ($request->hsn_code as $req_hsn_code){
                        $hsn_code[] = $req_hsn_code;
                    }
                    $data->hsn_code = $hsn_code;

                    $description = $data->description;
                    foreach ($request->description as $req_description){
                        $description[] = $req_description;
                    }
                    $data->description = $description;

                    $purchase_price = $data->purchase_price;
                    foreach ($request->purchase_price as $req_purchase_price){
                        $purchase_price[] = $req_purchase_price;
                    }
                    $data->purchase_price = $purchase_price;

                    $selling_price = $data->selling_price;
                    foreach ($request->selling_price as $req_selling_price){
                        $selling_price[] = $req_selling_price;
                    }
                    $data->selling_price = $selling_price;
                    
                    $mrp_price = $data->mrp_price;
                    foreach ($request->mrp_price as $req_mrp_price){
                        $mrp_price[] = $req_mrp_price;
                    }
                    $data->mrp_price = $mrp_price;

                    $discount_price = $data->discount_price;
                    foreach ($request->discount_price as $req_discount_price){
                        $discount_price[] = $req_discount_price;
                    }
                    $data->discount_price = $discount_price;

                    $discount_type = $data->discount_type;
                    foreach ($request->discount_type as $req_discount_type){
                        $discount_type[] = $req_discount_type;
                    }
                    $data->discount_type = $discount_type;

                    $sku_code = $data->sku_code;
                    foreach ($request->sku_code as $req_sku_code){
                        $sku_code[] = $req_sku_code;
                    }
                    $data->sku_code = $sku_code;

                    $quantity = $data->quantity;
                    foreach ($request->quantity as $req_quantity){
                        $quantity[] = $req_quantity;
                    }
                    $data->quantity = $quantity;

                }else{

                    $data = new VendorProduct;
                    $data->user_id = auth()->id();
                    $data->bakery_product_id = $bakery_product_id;
                    $data->category_id = $bakery_product->category_id;
                    $data->sub_category_id = $bakery_product->sub_category_id;
                    $data->attribute_id = $attribute_id;
                    $data->variation_name = $variation_name;
                    $data->variation_value = $request->variation_value;
                    $data->product_name =  $bakery_product->product_name;
                    $data->combination_name = $request->combination_name;
                    $data->thumbnail = $request->thumbnail;
                    $data->gallery = $request->gallery;
                    $data->tax = $request->tax;
                    $data->hsn_code = $request->hsn_code;
                    $data->description = $request->description;
                    $data->purchase_price = $request->purchase_price;
                    $data->selling_price = $request->selling_price;
                    $data->mrp_price = $request->mrp_price;
                    $data->discount_price = $request->discount_price;
                    $data->discount_type = $request->discount_type;
                    $data->sku_code = $request->sku_code;
                    $data->quantity = $request->quantity;
                    
                }
                $data->save();
            }
            return redirect()->route('vendor.products.index')->with('success','Product Added!');
        }else{
            return back()->with('error','No Product Selected');
        }
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
        $edit_data = VendorProduct::find($id);
        return view('backend.vendor.product.edit', compact('key', 'page', 'edit_data'));
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
        $data = VendorProduct::find($id);
        $data->variation_value = $request->variation_value;
        $data->product_name =  $request->product_name;
        $data->combination_name = $request->combination_name;
        $data->thumbnail = $request->thumbnail;
        $data->gallery = $request->gallery;
        $data->tax = $request->tax;
        $data->hsn_code = $request->hsn_code;
        $data->description = $request->description;
        $data->purchase_price = $request->purchase_price;
        $data->selling_price = $request->selling_price;
        $data->mrp_price = $request->mrp_price;
        $data->discount_price = $request->discount_price;
        $data->discount_type = $request->discount_type;
        $data->sku_code = $request->sku_code;
        $data->quantity = $request->quantity;
        $data->save();
        return redirect()->route('vendor.products.index',['key='.$key.'&page='.$page])->with('success','Product Updated!');

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
        VendorProduct::find($id)->delete();
        return redirect()->route('vendor.products.index',['key='.$key.'&page='.$page])->with('error','Product Deleted!');

    }

    public function getProducts(Request $request)
    {
        if($request->isChecked == "true"){

            $product = BakeryProduct::find($request->product_id);
            $check = new CheckVendorProductList;
            $check->user_id = auth()->id();
            $check->product_id = $request->product_id;
            $check->variation_value = $request->variation_value;
            $check->variation_str_value = $request->variation_str_value;
            $check->save(); 
            $variationStrValue = $request->variation_str_value;
            $variationValue = $request->variation_value;
            return view('backend.vendor.product.selected_product_list', compact('product', 'variationStrValue', 'variationValue'))->render();
        }else{
            $check = CheckVendorProductList::where('user_id', auth()->id())->where('product_id', $request->product_id)->where('variation_str_value', $request->variation_str_value)->delete();
            return "remove";
        }
        
    }

    public function productsFilter(Request $request)
    {  
        $bakeryProductList=BakeryProduct::orderBy('product_name','asc');
        if(!empty($request->category_id)){
            $bakeryProductList = $bakeryProductList->where('category_id',$request->category_id);
        }
        if(!empty($request->variation_id)){
            $bakeryProductList = $bakeryProductList->where('variant_id', $request->variation_id);
        }
        if(!empty($request->product_name)){
            $bakeryProductList = $bakeryProductList->where('product_name', 'like','%'.$request->product_name.'%');
        }
        $bakeryProductList = $bakeryProductList->with('bakeryVariation')->paginate(25);
        return view('backend.vendor.product.brakery_product_list', compact('bakeryProductList'));
    }
}
