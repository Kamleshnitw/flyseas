<?php

namespace App\Http\Controllers\Admin\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Vendor\VendorBanner;

class VendorBannerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vendor-banner-index', ['only' => ['index']]);
        $this->middleware('permission:vendor-banner-create', ['only' => ['create','store']]);
        $this->middleware('permission:vendor-banner-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = VendorBanner::where('user_id', auth()->id())->get();
        return view('backend.vendor.banner.index', compact('list'));
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
            'banner_type' => 'required',
            'banner' => 'required',
        ]);
        
        $data = VendorBanner::where('user_id', auth()->id())->where('banner_type', $request->banner_type)->first();
        $message = "Banner Update successfully!";
        if(!$data){
            $data = new VendorBanner;
            $message = "Banner Added successfully!";
        }
        $data->user_id = auth()->id();
        $data->banner_type = $request->banner_type;
        $data->banner = $request->banner;
        $data->save();

        return redirect()->route('vendor.banner.index')->with('success', $message);
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
        VendorBanner::find($id)->delete();
        return redirect()->route('vendor.banner.index')->with('error','Banner has been deleted successfully');
    }
}
