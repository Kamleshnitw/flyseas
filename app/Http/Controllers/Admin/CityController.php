<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:city-index', ['only' => ['index']]);
        $this->middleware('permission:city-create', ['only' => ['create','store']]);
        $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=City::orderBy('name','asc');
        $search=$request->key;
        if(!empty($search))
        {
            $list=$list->where('name','like','%'.$search.'%');
        }

        $page=$request->page;
        $list=$list->paginate(25);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('city.index',['key='.$search.'&page='.$page])->with('error', 'City Deleted');
        }

        return view('backend.city.index',compact('list','search'));
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
        return view('backend.city.create',compact('key','page'));
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

        $city=new City;
        $city->name=$request->name;
        $city->save();

        return redirect()->route('city.index',['key='.$key.'&page='.$page])->with('success','Bakery Added!');
        
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
        $edit_city=City::find($id);
        $list=City::orderBy('name','asc');
        $search=$request->key;
        if(!empty($search))
        {
            $list=$list->where('name','like','%'.$search.'%');
        }

        $page=$request->page;
        $list=$list->paginate(25);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('city.index',['key='.$search.'&page='.$page])->with('error', 'City Deleted');
        }

        return view('backend.city.index',compact('edit_city','list','search'));
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

        $city=City::find($id);
        $city->name=$request->name;
        $city->save();

        return redirect()->route('city.index',['key='.$key.'&page='.$page])->with('success','City Updated!');
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

        City::find($id)->delete();
        return redirect()->route('city.index',['key='.$key.'&page='.$page])->with('error','City Deleted!');

    }
}
