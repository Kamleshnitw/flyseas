<?php

namespace App\Http\Controllers\Admin\Bakery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Bakery\BakeryCategory;
use App\Models\Admin\Bakery\BakerySubCategory;

class BakerySubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=BakerySubCategory::orderBy('name','asc');
        $search=$request->key;
        if(!empty($search))
        {
            $list=$list->where('name','like','%'.$search.'%');
        }

        $page=$request->page;
        $list=$list->with('bakeryCategory')->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('subcategories.index',['key='.$search.'&page='.$page])->with('error', 'Bakery Sub Category Deleted');
        }

        return view('backend.bakery.subcategory.index',compact('list','search'));
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
        $category=BakeryCategory::orderBy('name','asc')->get();
        return view('backend.bakery.subcategory.create',compact('key','page', 'category'));
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

        $data=new BakerySubCategory;
        $data->categorie_id = $request->bakery_categorie_id;
        $data->name=$request->name;
        $data->thumbnail_image=$request->thumbnail_image;
        $data->save();

        return redirect()->route('subcategories.index',['key='.$key.'&page='.$page])->with('success','Bakery Sub Category Added!');
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

        $data=BakerySubCategory::find($id);
        $data->is_active=$request->is_active;
        $data->save();

        if($request->is_active)
        {
            return redirect()->route('subcategories.index',['key='.$key.'&page='.$page])->with('success','Bakery Sub Category Activeted!');
        }
        else
        {
            return redirect()->route('subcategories.index',['key='.$key.'&page='.$page])->with('error','Bakery SubCategory Deactiveted!');
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
        $category=BakeryCategory::orderBy('name','asc')->get();
        $edit_data=BakerySubCategory::find($id);

        return view('backend.bakery.subcategory.edit',compact('edit_data','category','key','page'));
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

        $edit_data=BakerySubCategory::find($id);
        $edit_data->categorie_id = $request->bakery_categorie_id;
        $edit_data->name=$request->name;
        $edit_data->thumbnail_image=$request->thumbnail_image;
        $edit_data->save();

        return redirect()->route('subcategories.index',['key='.$key.'&page='.$page])->with('success','Bakery Sub Category Updated!');

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

        BakerySubCategory::find($id)->delete();

        return redirect()->route('subcategories.index',['key='.$key.'&page='.$page])->with('error','Bakery Sub Category Deleted!');
    }

    public function subcategoriesByCategories($categorie_id)
    {
        return $category=BakerySubCategory::where('categorie_id', $categorie_id)->orderBy('name','asc')->get();
    }
}
