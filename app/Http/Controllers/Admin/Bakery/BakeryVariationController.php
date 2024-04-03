<?php

namespace App\Http\Controllers\Admin\Bakery;

use Illuminate\Http\Request;
use App\Models\Admin\Bakery\BakeryProduct;
use App\Models\Admin\Bakery\BakeryCategory;
use App\Models\Admin\Bakery\BakeryVariation;

class BakeryVariationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bakery-attribute-index', ['only' => ['index']]);
        $this->middleware('permission:bakery-attribute-create', ['only' => ['create','store']]);
        $this->middleware('permission:bakery-attribute-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bakery-attribute-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $list=BakeryVariation::orderBy('name','asc')->with(['productCategory']);
        $search=$request->key;
        if(!empty($search))
        {
            $list=$list->where('name','like','%'.$search.'%');
        }

        $page=$request->page;
        $list=$list->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('variations.index',['key='.$search.'&page='.$page])->with('error', 'Bakery Variation Deleted');
        }

        return view('backend.bakery.variation.index',compact('list','search'));



        // $list=BakeryVariation::orderBy('name','asc')->paginate(10);

        // return view('backend.bakery.variation.index',compact('list'));
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
        return view('backend.bakery.variation.create',compact('key','page','category'));
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

        $bakery_variation=new BakeryVariation;
        $bakery_variation->name=$request->name;
        $bakery_variation->category_id=$request->category_id;
        $bakery_variation->value=$request->value;
        $bakery_variation->save();

        return redirect()->route('variations.index',['key='.$key.'&page='.$page])->with('success','Bakery Category Added!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\BakeryVariation  $bakeryVariation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        $bakery_variation=BakeryVariation::find($id);
        $category=BakeryCategory::all();

        return view('backend.bakery.variation.edit',compact('bakery_variation','key','page','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\BakeryVariation  $bakeryVariation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $key=$request->key;
        $page=$request->page;

        $bakery_variation=BakeryVariation::find($id);
        $bakery_variation->name=$request->name;
        $bakery_variation->category_id=$request->category_id;
        $bakery_variation->value=$request->value;
        $bakery_variation->save();

        return redirect()->route('variations.index',['key='.$key.'&page='.$page])->with('success','Bakery Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\BakeryVariation  $bakeryVariation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        BakeryVariation::find($id)->delete();

        $checkVariationProduct = BakeryProduct::where('variant_id', $id)->get();
        if($checkVariationProduct->count()>0){
            foreach ($checkVariationProduct as $key => $product) {
                $product->delete();
            }
        }

        return redirect()->route('variations.index',['key='.$key.'&page='.$page])->with('error','Bakery Category Deleted!');
    }

}
