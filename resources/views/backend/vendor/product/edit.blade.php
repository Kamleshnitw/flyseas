@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('vendor.products.index')}}">Manage Products List</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
                                    <form action="{{route('vendor.products.update', $edit_data->id)}}" method="POST" class="form-example">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Product Name</label>
                                                        <input type="text" class="form-control" id="name" name="product_name" placeholder="Enter Product Name" value="{{$edit_data->product_name}}" required>
                                                    </div>
                                                </div>
                                                @php $i=1; @endphp
                                                
                                                @foreach ($edit_data->variation_value as $key => $variation_value)
                                                    <div class="main_div row">
                                                        <a href="#" class="btn btn-danger">X</a>
                                                        <input type="hidden" name="variation_value[]" value="{{$variation_value}}">
                                                        <div class="col-md-12">
                                                            
                                                            <h4>{{$i++}}. {{$edit_data->product_name}}{{$edit_data->combination_name[$key]}}</h4> 
                                                            <input type="hidden" name="combination_name[]" value="{{$edit_data->combination_name[$key]}}">
                                                            <hr>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Thumbnail Image</label>
                                                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                                    <div class="form-control file-amount">Choose Thumbnail Image</div>
                                                                    <input type="hidden" name="thumbnail[]" class="selected-files" value="{{$edit_data->thumbnail[$key]}}" required>
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
                                                                <label>Gallery</label>
                                                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                                    <div class="form-control file-amount">Choose Gallery Image</div>
                                                                    <input type="hidden" name="gallery[]" class="selected-files" value="{{$edit_data->gallery[$key]}}" required>
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
                                                                <label>Purchase Price</label>
                                                                <input type="number" class="form-control" name="purchase_price[]" placeholder="Enter Purchase Price" value="{{$edit_data->purchase_price[$key]}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label >MRP Price</label>
                                                                <input type="number" class="form-control" name="mrp_price[]" placeholder="Enter MRP Price" value="{{$edit_data->mrp_price[$key]}}" id="mrp_price_{{$edit_data->combination_name[$key]}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label >Selling Price</label>
                                                                <input type="number" class="form-control" name="selling_price[]" placeholder="Enter Selling Price" value="{{$edit_data->selling_price[$key]}}" id="selling_price_{{$edit_data->combination_name[$key]}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label >Discount Price</label>
                                                                <input type="number" class="form-control" name="discount_price[]" placeholder="Enter Discount Price" value="{{$edit_data->discount_price[$key]}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label >Discount Type</label>
                                                                <select name="discount_type[]" class="form-control">
                                                                    <option value="%" @if ($edit_data->discount_type[$key] == "%")selected @endif>%</option>
                                                                    <option value="fixed" @if ($edit_data->discount_type[$key] == "fixed")selected @endif>fixed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label >Sku Code</label>
                                                                <input type="text" class="form-control" name="sku_code[]" placeholder="Enter Sku Code" value="{{$edit_data->sku_code[$key]}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label >Quantity</label>
                                                                <input type="number" class="form-control" name="quantity[]" placeholder="Enter Product Quantity" value="{{$edit_data->quantity[$key]}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea class="form-control" id="description" name="description[]" placeholder="Enter Product Description....." required rows="5">{{$edit_data->description[$key]}}</textarea>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="tax[]" value="{{$edit_data->tax[$key]}}">
                                                        <input type="hidden" name="hsn_code[]" value="{{$edit_data->hsn_code[$key]}}">

                                                        <script>
                                                            $(document).ready(function(){
                                                                $("#selling_price_{{$edit_data->combination_name[$key]}}").on('keyup',function(){
                                                                    var mrp_price = parseInt($('#mrp_price_{{$edit_data->combination_name[$key]}}').val());
                                                                    var selling_price = parseInt($('#selling_price_{{$edit_data->combination_name[$key]}}').val());
                                                                
                                                                    if(mrp_price < selling_price){
                                                                        alert('Selling Price is not greater than MRP Price !!');
                                                                        $('#selling_price_{{$edit_data->combination_name[$key]}}').val('');
                                                                    }
                                                                });
                                                        
                                                                $("#mrp_price_{{$edit_data->combination_name[$key]}}").on('keyup',function(){
                                                                    var mrp_price = $('#mrp_price_{{$edit_data->combination_name[$key]}}').val();
                                                                    $('#selling_price_{{$edit_data->combination_name[$key]}}').val('');
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Update this product?');"><i class="fa fa-check" aria-hidden="true"></i> Update</button>
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
    <script>
        var totalVariation="{{count($edit_data->variation_value)}}";
        $(".main_div a").click(function(e) {
            totalVariation-=1;
            if(totalVariation>=1){
                e.preventDefault();
                $(this).parent().remove();
            }else{
                alert("You can not remove all variation.");
            }
        });
    </script>
@endsection