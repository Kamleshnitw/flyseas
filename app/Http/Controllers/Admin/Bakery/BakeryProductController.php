<?php

namespace App\Http\Controllers\Admin\Bakery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Bakery\BakeryProduct;
use App\Models\Admin\Bakery\BakeryCategory;
use App\Models\Admin\Bakery\BakeryVariation;

class BakeryProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bakery-product-index', ['only' => ['index']]);
        $this->middleware('permission:bakery-product-create', ['only' => ['create','store']]);
        $this->middleware('permission:bakery-product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bakery-product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=BakeryProduct::orderBy('product_name','asc');
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
            return redirect()->route('products.index',['key='.$search.'&page='.$page])->with('error', 'Bakery Product Deleted');
        }

        return view('backend.bakery.product.index',compact('list','search'));
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
        $category=BakeryCategory::all();
        return view('backend.bakery.product.create',compact('key', 'page', 'category'));
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

        $variationData = [];
        $options = [];
        foreach ($request->variation_id as $variation_id) {
            $variations = BakeryVariation::find($variation_id);
            $variation_value = explode(',', $variations->value);
            $variationData[] = ['id' => $variation_id, 'name' => $variations->name];
            $options[] = $variation_value;
        }

        $data = new BakeryProduct;
        $data->category_id = $request->category_id;
        $data->sub_category_id = $request->sub_category_id;
        $data->variation_data = $variationData;
        $data->variation_options = $options;
        $data->product_name = $request->product_name;
        $data->thumbnail = $request->thumbnail;
        $data->gallery = $request->gallery;
        $data->tax = $request->tax;
        $data->gst = $request->gst;
        $data->hsn_code = $request->hsn_code;
        $data->description = $request->description;
        $data->save();
        //return makeCombinations($options);
        return redirect()->route('products.index',['key='.$key.'&page='.$page])->with('success','Bakery Product Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $key=$request->key;
        $page=$request->page;
        $data=BakeryProduct::where('id',$id)->first();
        $data->is_active = $request->is_active;
        $data->save();

        if($request->is_active)
        {
            return redirect()->route('products.index',['key='.$key.'&page='.$page])->with('success','Bakery Product Activeted');
        }
        else
        {
            return redirect()->route('products.index',['key='.$key.'&page='.$page])->with('error','Bakery Product Not Deactiveted');
        }
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
        $category=BakeryCategory::all();
        $edit_data=BakeryProduct::find($id);
        $selected_variation_id =[];
        foreach($edit_data->variation_data as $variation_data){
            $selected_variation_id[]=$variation_data['id'];
        }
        return view('backend.bakery.product.edit',compact('selected_variation_id','category','edit_data','key','page'));
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
        
        $variationData = [];
        $options = [];
        foreach ($request->variation_id as $variation_id) {
            $variations = BakeryVariation::find($variation_id);
            $variation_value = explode(',', $variations->value);
            $variationData[] = ['id' => $variation_id, 'name' => $variations->name];
            $options[] = $variation_value;
        }

        $data = BakeryProduct::find($id);
        $data->category_id = $request->category_id;
        $data->sub_category_id = $request->sub_category_id;
        $data->variation_data = $variationData;
        $data->variation_options = $options;
        $data->product_name = $request->product_name;
        $data->thumbnail = $request->thumbnail;
        $data->gallery = $request->gallery;
        $data->tax = $request->tax;
        $data->gst = $request->gst;
        $data->hsn_code = $request->hsn_code;
        $data->description = $request->description;
        $data->save();
        return redirect()->route('products.index',['key='.$key.'&page='.$page])->with('success','Bakery Product Update!');    
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

        $data = BakeryProduct::find($id)->delete($id);

        return redirect()->route('products.index',['key='.$key.'&page='.$page])->with('error','Bakery Products Deleted!');
    }

    public function categoryVariations($category_id)
    {
        return $variations = BakeryVariation::where('category_id', $category_id)->get();
    }

    public function VariationsValue($id)
    {
        $variation_ids = explode(',', $id);
        $variations = BakeryVariation::whereIn('id', $variation_ids)->get();
        $variations_value = [];
        foreach ($variations as $variation){
            $variations_value[] = $variation->value;
        }
        return $variations_value;
    }

    public function featured(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;
        $data=BakeryProduct::find($id);
        $data->is_feature = $request->is_feature;
        $data->save();
        if($request->is_feature)
        {
            return redirect()->route('products.index',['key='.$key.'&page='.$page])->with('success','Bakery Product Featured');
        }
        else
        {
            return redirect()->route('products.index',['key='.$key.'&page='.$page])->with('error','Bakery Product Not Featured');
        }
    }
}
