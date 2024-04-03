@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Add Offer</li>
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
                                    <form action="{{route('vendor.offer.store')}}" method="POST" class="form-example">
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Banner</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Offer Banner</div>
                                                            <input type="hidden" name="banner" class="selected-files" required>
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
                                                            <option value="category">Category</option> 
                                                            <option value="product">Products</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="last_date">Last Date</label>
                                                        <input type="date" class="form-control" id="last_date" name="last_date" required> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="for_user">User Type</label>
                                                        <select class="form-control" id="for_user" name="for_user" required>
                                                            <option value="" selected disabled>Select</option> 
                                                            <option value="new_users">New Users</option>
                                                            <option value="all_users">All Users</option> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="discount">Discount</label>
                                                        <input type="number" class="form-control" id="discount" name="discount" required> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="discount_type">Discount Type</label>
                                                        <select class="form-control" id="discount_type" name="discount_type" required> 
                                                            <option value="%">Percentage</option>
                                                            <option value="flat">Flat</option> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="minimum_value">Minimum Value</label>
                                                        <input type="number" class="form-control" id="minimum_value" name="minimum_value" required> 
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="minimum_value_type">Minimum Value Type</label>
                                                        <select class="form-control" id="minimum_value_type" name="minimum_value_type" required>
                                                            <option value="" selected disabled>Select</option> 
                                                            <option value="cart">Cart</option>
                                                            <option value="product">Product</option> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="category_id">Category</label>
                                                        <select class="form-control select2" data-placeholder="Select category" multiple id="category_id" name="category_id[]" onchange="get_product()">
                                                            
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
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this offer?');"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
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
            var category_id=$('#category_id').val();
            var offer_type = $('#offer_type').val();
            $('#product_list_div').empty();
            $.get("{{ route('vendor.getProductbyCategory') }}?category_id="+category_id+"&offer_type="+offer_type,function(data) {
                //console.log(data);
                $("#product_list_div").append(data);
            });
        }
    </script>
@endsection
