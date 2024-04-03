@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Products List</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    <form method="post" id="product_filter_form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category">Category</label>
                                                    <select class="form-control select2" id="category" name="category_id" required onchange="get_variation()">
                                                        <option value="" selected disabled>Select Category</option>
                                                        @foreach (App\Models\Admin\Bakery\BakeryCategory::all(); as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach   
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="variation">Variations</label>
                                                    <select class="form-control select2" id="variation" name="variation_id" required onchange="product_filter()">
                                                        <option value="">Select..</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="product_name" class="form-control" id="product_name" Placeholder="Search By Product Name" onkeyup="product_filter()">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    @include('backend.vendor.product.brakery_product_list')
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card card-outline card-info">
                            <form method="POST" action="{{route('vendor.products.store')}}">
                                @csrf
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="card-title">Selected Products List</h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-outline-success">Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product Info</th>
                                                    <th>Purchase Price</th>
                                                    <th>MRP Price</th>
                                                    <th>Selling Price</th>
                                                    <th>Discount</th>
                                                    <th>Discount Type</th>
                                                    <th>SKU Code</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selected_product_div">
                                                @php
                                                    $CheckVendorProductLists=App\Models\Admin\Vendor\CheckVendorProductList::where('user_id', auth()->id())->get();
                                                @endphp
                                                @if($CheckVendorProductLists->count() > 0)
                                                    @foreach ($CheckVendorProductLists as $key => $CheckVendorProductList)
                                                        @php
                                                            $product = App\Models\Admin\Bakery\BakeryProduct::find($CheckVendorProductList->product_id);
                                                        @endphp
                                                        <tr id="product_row_{{$product->id}}{{$CheckVendorProductLists[$key]->variation_str_value}}">
                                                            <input type="hidden" name="bakery_product_id[]" value="{{$product->id}}">
                                                            {{-- <input type="hidden" name="category_id[]" value="{{$product->category_id}}">
                                                            <input type="hidden" name="sub_category_id[]" value="{{$product->sub_category_id}}">
                                                            <input type="hidden" name="product_name[]" value="{{$product->product_name}}"> --}}
                                                            <input type="hidden" name="variation_value[]" value="{{$CheckVendorProductLists[$key]->variation_value}}">
                                                            <input type="hidden" name="combination_name[]" value="{{$CheckVendorProductLists[$key]->variation_str_value}}">
                                                            <input type="hidden" name="thumbnail[]" value="{{$product->thumbnail}}">
                                                            <input type="hidden" name="gallery[]" value="{{$product->gallery}}">
                                                            <input type="hidden" name="tax[]" value="{{$product->tax}}">
                                                            <input type="hidden" name="hsn_code[]" value="{{$product->hsn_code}}">
                                                            <input type="hidden" name="description[]" value="{{$product->description}}">
                                                
                                                            <td>
                                                                {{$product->product_name}}{{$CheckVendorProductLists[$key]->variation_str_value}}
                                                            </td>
                                                            <td><input type="number" class="form-control" name="purchase_price[]" placeholder="Purchase Price" required></td>
                                                            <td><input type="number" class="form-control" name="mrp_price[]" id="mrp_price_{{$product->id}}" placeholder="MRP Price" required></td>
                                                            <td><input type="number" class="form-control" name="selling_price[]" id="selling_price_{{$product->id}}" placeholder="Seller Price" required></td>
                                                            <td><input type="number" class="form-control" name="discount_price[]" placeholder="Discount Price" required></td>
                                                            <td>
                                                                <select name="discount_type[]" class="form-control">
                                                                    <option value="%">%</option>
                                                                    <option value="fixed">fixed</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" class="form-control" name="sku_code[]" placeholder="SKU code" required></td>
                                                            <td><input type="number" class="form-control" name="quantity[]" placeholder="Product Quantity" required></td>
                                                        </tr>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $("#selling_price_{{$product->id}}").on('keyup',function(){
                                                                    var mrp_price = parseInt($('#mrp_price_{{$product->id}}').val());
                                                                    var selling_price = parseInt($('#selling_price_{{$product->id}}').val());
                                                                   
                                                                    if(mrp_price < selling_price){
                                                                        alert('Selling Price is not greater than MRP Price !!');
                                                                        $('#selling_price_{{$product->id}}').val('');
                                                                    }
                                                                });
                                                        
                                                                $("#mrp_price_{{$product->id}}").on('keyup',function(){
                                                                    var mrp_price = $('#mrp_price_{{$product->id}}').val();
                                                                    $('#selling_price_{{$product->id}}').val('');
                                                                });
                                                            });
                                                        </script>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        // function checkProduct(){
        //     var product_id = $(".checkProduct").val();
        //     var isChecked = $('#product_id_'+product_id).is(':checked');
        //     $.get("{{ route('get_products') }}"+"?product_id="+product_id+"&"+"isChecked="+isChecked, function(data) {
        //         if(data!= "remove"){
        //             $('#selected_product_div').append(data);
        //         }else{
        //             $('#product_row_'+product_id).remove();
        //         }
        //     });
        // }
        
        $(document).ready(function(){
            $('body').removeClass('sidebar-mini layout-fixed');
            $('body').addClass("sidebar-collapse")
        });

        function checkProduct(variation_str_value, product_id){
            var variation_value = $('#product_id'+variation_str_value).val();
            var isChecked = $('#product_id'+variation_str_value).is(':checked');
            $.get("{{ route('get_products') }}"+"?product_id="+product_id+"&variation_value="+variation_value+"&variation_str_value="+variation_str_value+"&isChecked="+isChecked, function(data) {
                if(data!= "remove"){
                    $('#selected_product_div').append(data);
                }else{
                    $('#product_row_'+product_id+variation_str_value).remove();
                }
            });
        }

        // $(document).ready(function(){
        //     $(".checkProduct").on('click',function(){
        //         var product_id = $(this).val();
        //         var isChecked = $('#product_id_'+product_id).is(':checked');
        //         $.get("{{ route('get_products') }}"+"?product_id="+product_id+"&"+"isChecked="+isChecked, function(data) {
        //             if(data!= "remove"){
        //                 $('#selected_product_div').append(data);
        //             }else{
        //                 $('#product_row_'+product_id).remove();
        //             }
        //         });

        //     });
        // });

        
        function get_variation() {
            var category_id = $('#category').val();
            $('#variation').empty();
            $.get("{{ route('category-variations', '') }}" + "/" + category_id, function(data) {
                $('#variation').append("<option value=''> Select...</option>");
                $.each(data, function(key, val) {
                    $('#variation').append("<option value=" + val.id + ">" + val.name + "</option>");
                });
                product_filter();
            });
        }

        function product_filter()
        {
            $.post("{{ route('products_filter') }}", $("#product_filter_form").serialize(), function(data) {
                //console.log(data);
                $('#bakery_product_list').html(data);
            });
        }
    </script>
    <script>
        $(document).on('click', '.pagination_class a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
        function fetch_data(page) {
            $.ajax({
                url:"{{ route('vendor.products.create') }}"+"?page="+page,
                success: function(data) {
                    window.history.pushState("", "", "{{ route('vendor.products.create') }}"+"?page="+page);
                    $('#bakery_product_list').html(data);
                },
            });
        }
        function filter_data() {
            var page = $('#current_page_number').val();
            fetch_data(page);
        }
    </script>
    
@endsection
