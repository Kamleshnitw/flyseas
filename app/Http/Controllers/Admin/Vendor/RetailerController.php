<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Models\Retailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RetailerWalletHistory;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->user_type=="super_admin" || auth()->user()->user_type=="admin"){
            $list = Retailer::orderBy('id', 'desc')->with('retailerKyc');
        }else{
            $list = Retailer::where('city_id', auth()->user()->userDetails->city_id)->orderBy('id', 'desc')->with('retailerKyc');
        }
        $search=$request->key;
        $page=$request->page;
        $list=$list->with('user')->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('vendor.retailers.index',['key='.$search.'&page='.$page])->with('error', 'No Data Found');
        }

        return view('backend.vendor.retailer.index',compact('list','search'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Retailer::find($id);
        return view('backend.vendor.retailer.show',compact('data'));
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
        $this->validate($request, [
            'amount'     => 'required|numeric|min:0',
        ]);
        $data = Retailer::find($id);
        $data->wallet_balance = $data->wallet_balance + $request->amount;
        $data->save();
        
        $history = new RetailerWalletHistory;
        $history->user_id = $data->user_id;
        $history->type = "credit";
        $history->amount = $request->amount;
        $history->save();

        return redirect()->back()->with('success', 'Amount added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
