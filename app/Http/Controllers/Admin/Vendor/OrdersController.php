<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->user_type=="super_admin" || auth()->user()->user_type=="admin"){
            $list = Order::orderBy('id', 'desc');
        }else{
            $list = Order::where('city_id', auth()->user()->userDetails->city_id)->orderBy('id', 'desc');
        }
        $search=$request->key;
        $page=$request->page;
        $list=$list->with('address')->paginate(10);
        if($list->lastPage()>=$page){
        }else{
            $page=$page - 1;
            return redirect()->route('vendor.orders.index',['key='.$search.'&page='.$page])->with('error', 'No Data Found');
        }

        return view('backend.vendor.order.index',compact('list','search'));
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
        $data = Order::find(decrypt($id));
        return view('backend.vendor.order.show', compact('data'));
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
        $data = Order::find($id);
        $data->payment_status = $request->payment_status;
        if($data->order_status != $request->order_status){
            $order_history = $data->order_history;
            $order_history[] = ['order_status' => $request->order_status, 'time' => date('Y-m-d H:i:s')];
            $data->order_history = $order_history;
            $data->order_status = $request->order_status;

            $productDetailsArr= [];
            foreach(json_decode($data->product_details) as $productDetails){
                $productDetails->status = $request->order_status;
                $productDetailsArr[] = $productDetails;
            };
            $data->product_details = json_encode($productDetailsArr);

            $message = "Order ".$request->order_status.' Successfully !!';
        }
        $data->save();
        return redirect()->back()->with('success', $message);
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

    public function orderInvoice($order_id)
    {
        $data = Order::where('order_id', $order_id)->first();
        return view('backend.vendor.order.invoice', compact('data'));
    }
}
