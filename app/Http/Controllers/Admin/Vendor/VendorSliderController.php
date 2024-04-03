<?php

namespace App\Http\Controllers\Admin\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\VendorSlider;

class VendorSliderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vendor-slider-index', ['only' => ['index']]);
        $this->middleware('permission:vendor-slider-create', ['only' => ['create','store']]);
        $this->middleware('permission:vendor-slider-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = VendorSlider::where('user_id', auth()->id())->get();
        return view('backend.vendor.slider.index', compact('list'));
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
        $this->validate($request, [
            'slider_type' => 'required',
            'slider' => 'required',
        ]);
        
        $data = VendorSlider::where('user_id', auth()->id())->where('slider_type', $request->slider_type)->first();
        $message = "Slider Update successfully!";
        if(!$data){
            $data = new VendorSlider;
            $message = "Slider Added successfully!";
        }
        $data->user_id = auth()->id();
        $data->slider_type = $request->slider_type;
        $data->slider = $request->slider;
        $data->save();

        return redirect()->route('vendor.slider.index')->with('success', $message);
        
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        VendorSlider::find($id)->delete();
        return redirect()->route('vendor.slider.index')->with('error', 'Slider has been deleted successfully');
    }
}
