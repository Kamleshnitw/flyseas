@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Offer</li>
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
                                    <form action="{{route('vendor.offer.update', $edit_data->id)}}" method="POST" class="form-example">
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
                                                        <label for="offer_type">Offer Type</label>
                                                        <select class="form-control" id="offer_type" name="type" onchange="check_offer_type()" required>
                                                            <option value="" selected disabled>Select</option> 
                                                            <option value="category" @if($edit_data->type == 'category') selected @endif>Category</option> 
                                                            <option value="product" @if($edit_data->type == 'product') selected @endif>Products</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="last_date">Last Date</label>
                                                        <input type="date" class="form-control" id="last_date" name="last_date" value="{{$edit_data->last_date}}" required> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="for_user">User Type</label>
                                                        <select class="form-control" id="for_user" name="for_user" required>
                                                            <option value="" selected disabled>Select</option> 
                                                            <option value="new_users" @if($edit_data->for_user == 'new_users') selected @endif>New Users</option>
                                                            <option value="all_users" @if($edit_data->for_user == 'all_users') selected @endif>All Users</option> 
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
                                                        <label for="minimum_value">Minimum Value</label>
                                                        <input type="number" class="form-control" id="minimum_value" name="minimum_value" value="{{$edit_data->minimum_value}}" required> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="minimum_value_type">Minimum Value Type</label>
                                                        <select class="form-control" id="minimum_value_type" name="minimum_value_type" required>
                                                            <option value="" selected disabled>Select</option> 
                                                            <option value="cart" @if($edit_data->minimum_value_type == 'cart') selected @endif>Cart</option>
                                                            <option value="product" @if($edit_data->minimum_value_type == 'product') selected @endif>Product</option> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="category_id">Category</label>
                                                        
                                                        <select class="form-control select2" data-placeholder="Select category" multiple id="category_id" name="category_id[]" onchange="get_product()">
                                                            @if ($edit_data->type=='category')
                                                                @php
                                                                    $all_cat = App\Models\Admin\Bakery\BakeryCategory::orderBy('name','asc')->get();
                                                                @endphp
                                                                @foreach ($all_cat as $cat)
                                                                    <option value="{{$cat->id}}" @if(in_array($cat->id, $edit_data->category_id)) selected @endif>{{$cat->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div id="product_list_div">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to update this offer?');"><i class="fa fa-check" aria-hidden="true"></i> UPDATE</button>
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
        $(function(){
            get_product();
        })
        function check_offer_type(){
            var offer_type = $('#offer_type').val();
            if(offer_type=="category") {
                $('#product_list_div').empty();
                get_category();
            }
            if(offer_type=="product"){
                $('#category_id').empty();
                get_product();
            }
        }

        function get_category(){
            $('#category_id').empty();
            $.get("{{ route('vendor.getAllCategory') }}",function(data) {
                $.each(data, function(key,val) {
                    $('#category_id').append("<option value="+val.id+">"+val.name+"</option>");
                });
            });
        }

        function get_product(){
            var edit_data_id = "{{$edit_data->id}}";
            var category_id=$('#category_id').val();
            var offer_type = $('#offer_type').val();
            $('#product_list_div').empty();
            $.get("{{ route('vendor.getProductbyCategory') }}?category_id="+category_id+"&offer_type="+offer_type+"&edit_data_id="+edit_data_id,function(data) {
                //console.log(data);
                $("#product_list_div").append(data);
            });
        }
    </script>
@endsection
