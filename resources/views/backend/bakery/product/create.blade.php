@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('products.index')}}">Bakery Products List</a></li>
                            <li class="breadcrumb-item active">Add Bakery Product</li>
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
                                    <form action="{{route('products.store')}}" method="POST" class="form-example">
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="category">Category</label>
                                                        <select class="form-control select2" id="category" name="category_id" required onchange="get_variation()">
                                                            <option value="" selected disabled>Select Category</option>
                                                            @foreach ($category as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach   
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="category">Sub Category</label>
                                                        <select class="form-control select2" id="subcategory" name="sub_category_id">
                                                            <option value="" selected disabled>Select Sub Category</option>
                                                             
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="variation">Variations</label>
                                                        <select class="form-control select2" id="variation" name="variation_id[]" multiple="multiple" data-placeholder="Select a Variation" onchange="get_variation_value()" required>
                                                             
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="variation_value">Variation Value</label>
                                                        <textarea class="form-control" name="variation_value" id="variation_value" rows="2" readonly required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">Product Name</label>
                                                        <input type="text" class="form-control" id="name" name="product_name" placeholder="Enter Product Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Thumbnail Image</label>
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                                            <div class="form-control file-amount">Choose Thumbnail Image</div>
                                                            <input type="hidden" name="thumbnail" class="selected-files" required>
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
                                                            <input type="hidden" name="gallery" class="selected-files" required>
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
                                                        <label for="gst">GST</label>
                                                        <input type="number" class="form-control" id="gst" name="gst" placeholder="Enter GST" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="tax">TAX</label>
                                                        <input type="text" class="form-control" id="tax" name="tax" placeholder="Enter tax" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">HSN Code</label>
                                                        <input type="text" class="form-control" id="name" name="hsn_code" placeholder="Enter HSN Code" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control" id="description" name="description" placeholder="Enter Product Description....." required rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
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
        function get_variation(){
            var category_id = $('#category').val();
            $('#variation').empty();
            $.get("{{ route('category-variations', '') }}"+"/"+category_id,function(data) {
                $.each(data, function(key,val) {
                    $('#variation').append("<option value="+val.id+">"+val.name+"</option>");
                });
            });
            get_subcategory(category_id);
        }

        function get_subcategory(category_id){
            $('#subcategory').empty();
            $('#subcategory').append("<option value='' selected>Select Sub Category</option>");
            $.get("{{ route('subcategoriesByCategories', '') }}"+"/"+category_id,function(data) {
                $.each(data, function(key,val) {
                    $('#subcategory').append("<option value="+val.id+">"+val.name+"</option>");
                });
            });
        }

        function get_variation_value(){
            var variation_id = $('#variation').val();
            if(variation_id != ""){
                $.get("{{ route('variations-value', '') }}"+"/"+variation_id,function(data) {
                    $("#variation_value").val(data);
                });
            }else{
                $('#variation_value').val('');
            } 
        }   
    </script>
@endsection
