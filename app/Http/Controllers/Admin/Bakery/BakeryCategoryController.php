<?php

namespace App\Http\Controllers\Admin\Bakery;

use App\Models\Admin\Bakery\BakeryCategory;
use Illuminate\Http\Request;

class BakeryCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bakery-category-index', ['only' => ['index']]);
        $this->middleware('permission:bakery-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:bakery-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bakery-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $list=BakeryCategory::orderBy('name','asc');
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
            return redirect()->route('categories.index',['key='.$search.'&page='.$page])->with('error', 'Bakery Category Deleted');
        }

        return view('backend.bakery.category.index',compact('list','search'));



        // $list=BakeryCategory::orderBy('name','asc')->paginate(10);

        // return view('backend.bakery.category.index',compact('list'));
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
        return view('backend.bakery.category.create',compact('key','page'));
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

        $bakery_category=new BakeryCategory;
        $bakery_category->name=$request->name;
        $bakery_category->thumbnail_image=$request->thumbnail_image;
        $bakery_category->save();

        return redirect()->route('categories.index',['key='.$key.'&page='.$page])->with('success','Bakery Category Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\BakeryCategory  $bakeryCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        $bakery_category=BakeryCategory::find($id);
        $bakery_category->is_active=$request->is_active;
        $bakery_category->save();

        if($request->is_active)
        {
            return redirect()->route('categories.index',['key='.$key.'&page='.$page])->with('success','Bakery Category Activeted!');
        }
        else
        {
            return redirect()->route('categories.index',['key='.$key.'&page='.$page])->with('error','Bakery Category Deactiveted!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\BakeryCategory  $bakeryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        $bakery_category=BakeryCategory::find($id);

        return view('backend.bakery.category.edit',compact('bakery_category','key','page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\BakeryCategory  $bakeryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $key=$request->key;
        $page=$request->page;

        $bakery_category=BakeryCategory::find($id);
        $bakery_category->name=$request->name;
        $bakery_category->thumbnail_image=$request->thumbnail_image;
        $bakery_category->save();

        return redirect()->route('categories.index',['key='.$key.'&page='.$page])->with('success','Bakery Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\BakeryCategory  $bakeryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        BakeryCategory::find($id)->delete();

       return redirect()->route('categories.index',['key='.$key.'&page='.$page])->with('error','Bakery Category Deleted!');
    }

    public function featured(Request $request,$id)
    {
        $key=$request->key;
        $page=$request->page;

        $bakery_category=BakeryCategory::find($id);
        $bakery_category->is_feature=$request->is_feature;
        $bakery_category->save();

        if($request->is_feature)
        {
            return redirect()->route('categories.index',['key='.$key.'&page='.$page])->with('success','Bakery Category Featured');
        }
        else
        {
            return redirect()->route('categories.index',['key='.$key.'&page='.$page])->with('error','Bakery Category Not Featured');
        }
    }
}
