@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Show Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> FLYSEAS
                                    <small class="float-right">Date: {{$data->created_at->format('d/m/Y')}}</small>
                                </h4>
                            </div>
                        </div>

                        <div class="row invoice-info">
                            {{-- <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>{{auth()->user()->name}}</strong><br>
                                    {{App\Models\Admin\City::find(auth()->user()->userDetails->city_id)->name}}<br>
                                    Phone: {{auth()->user()->phone}}<br>
                                    Email: {{auth()->user()->email}}
                                </address>
                            </div> --}}
                            
                            <div class="col-sm-6 invoice-col">
                                Retailer Details
                                <address>
                                    <strong>{{$data->user_name}}</strong><br>
                                    {{$data->address->address}}, <br>{{$data->address->city}}, {{$data->address->state}}, {{$data->address->country}} - {{$data->address->pincode}}<br>
                                    Phone: {{$data->user_phone}}<br>
                                    
                                </address>
                            </div>

                            <div class="col-sm-6 invoice-col text-right">
                                {{-- <b>Invoice #{{$data->order_id}}</b><br> --}}
                                <br>
                                <b>Order ID:</b> {{$data->order_id}}<br>
                                <b>Order Date:</b> {{$data->created_at->format('d/m/Y')}}<br>
                                {{-- <b>Account:</b> 968-34567 --}}
                            </div>

                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <form action="{{route('vendor.orders.update', $data->id)}}" method="post" id="order_status_form">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="payment_status">Payment Status</label>
                                            <select name="payment_status" class="form-control status" id="payment_status">
                                                <option value="Unpaid" @if($data->payment_status == "Unpaid")selected @endif>Unpaid</option>
                                                <option value="Paid" @if($data->payment_status == "Paid")selected @endif>Paid</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="order_status">Order Status</label>
                                            <select name="order_status" class="form-control status" id="order_status">
                                                <option value="Pending" @if($data->order_status == "Pending")selected @endif disabled>Pending</option>
                                                <option value="Confirmed" @if($data->order_status == "Confirmed")selected @endif>Confirmed</option>
                                                <option value="Cancelled" @if($data->order_status == "Cancelled")selected @endif>Cancelled</option>
                                                <option value="Rejected" @if($data->order_status == "Rejected")selected @endif>Rejected</option>
                                                <option value="OnDelivery" @if($data->order_status == "OnDelivery")selected @endif>OnDelivery</option>
                                                <option value="Delivered" @if($data->order_status == "Delivered")selected @endif>Delivered</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product Image</th>
                                            <th>Product</th>
                                            <th>MRP Price</th>
                                            <th>Selling Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $sellingPrice = 0; 
                                            $discountedSubTotal = 0;
                                            $subTotal = 0;
                                        @endphp

                                        @foreach (json_decode($data->product_details) as $productDetails)

                                            @php 
                                                $sellingPrice+=$productDetails->selling_price*$productDetails->quantity;
                                                $discountedSubTotal+=$productDetails->purchase_price*$productDetails->quantity;
                                                $subTotal+=$productDetails->mrp_price*$productDetails->quantity;
                                            @endphp

                                            <tr>
                                                <td>{{$productDetails->quantity}}</td>
                                                <td><img height="50" width="50" src="{{$productDetails->thumbnail}}" alt="Product Image"></td>
                                                <td>{{$productDetails->product_name}} {{$productDetails->combination_name}}</td>
                                                <td>₹ {{$productDetails->mrp_price}}</td>
                                                <td>₹ {{$productDetails->selling_price}}</td>
                                                <td>{{$productDetails->status}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-7">
                            </div>

                            <div class="col-5">
                                {{-- <p class="lead">Amount Due 2/22/2014</p> --}}
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>₹ {{$subTotal}} /-</td>
                                            </tr>
                                            <tr>
                                                <th style="width:50%">Selling Price:</th>
                                                <td>₹ {{$sellingPrice}} /-</td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Coupon Discount:</th>
                                                <td>₹ {{$data->coupon_discount}} /-</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>₹ 0 /-</td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total:</th>
                                                <td>₹ {{$data->grand_amount}} /-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <div class="row no-print">
                            <div class="col-12">
                                {{-- <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a> --}}
                                {{-- <button type="button" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button> --}}
                                <a href="{{route('order-invoice', $data->order_id)}}" target="_blank" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function(){
            $('.status').change(function(){
                $('#order_status_form').submit();
            })
        });
    </script>
@endsection
