@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Coupon</li>
                        </ol>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <form action="{{route('vendor.coupon.update', $edit_data->id)}}" method="POST" class="form-example">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Banner</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Offer Banner</div>
                                                            <input type="hidden" name="banner" class="selected-files" value="{{$edit_data->banner}}" required>
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                            </div>
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="coupon_name">Coupon Name</label>
                                                        <input type="text" class="form-control" id="coupon_name" name="coupon_name" placeholder="Enter Coupon Name" required onkeyup="this.value = this.value.toUpperCase();" value="{{$edit_data->coupon_name}}"> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="offer_type">Offer Type</label>
                                                        <select class="form-control" id="offer_type" name="uses_type" required>
                                                            <option value="" selected disabled>Select</option> 
                                                            <option value="first_time_use" @if($edit_data->uses_type=="first_time_use")selected @endif>First Time Use</option> 
                                                            <option value="all_time_use" @if($edit_data->uses_type=="all_time_use")selected @endif>All Time Use</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="discount">Discount</label>
                                                        <input type="number" class="form-control" id="discount" name="discount" value="{{$edit_data->discount}}" required> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="discount_type">Discount Type</label>
                                                        <select class="form-control" id="discount_type" name="discount_type" required> 
                                                            <option value="%" @if($edit_data->discount_type == '%') selected @endif>Percentage</option>
                                                            <option value="flat" @if($edit_data->discount_type == 'flat') selected @endif>Flat</option> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="minimum_order_amount">Minimum Order Amount</label>
                                                        <input type="number" class="form-control" id="minimum_order_amount" name="minimum_order_amount" value="{{$edit_data->minimum_order_amount}}" placeholder="Minimum Order Amount"> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date</label>
                                                        <input type="date" class="form-control" id="start_date" name="start_date" required value="{{$edit_data->start_date}}"> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="end_date">End Date</label>
                                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{$edit_data->end_date}}" required> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="short_description">Short Description</label>
                                                        <textarea class="form-control" name="short_description" id="short_description" rows="1" required placeholder="Short Description..">{{$edit_data->short_description}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="terms_conditions">Terms and Conditions</label>
                                                        <textarea class="form-control" name="terms_conditions" id="terms_conditions" rows="5" required placeholder="Terms and Conditions..">{{$edit_data->terms_conditions}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" ><i class="fa fa-check" aria-hidden="true"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
