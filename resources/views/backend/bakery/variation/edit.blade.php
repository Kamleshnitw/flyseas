@extends('backend.include.header')
@section('content')
    <link rel="stylesheet" href="{{ URL::asset('public/input_tag/tagsinput.css')  }}">
    <script src="{{ URL::asset('public/input_tag/tagsinput.js')  }}"></script>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('variations.index')}}">Bakery Variation List</a></li>
                            <li class="breadcrumb-item active">Bakery Variation</li>
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
                                    <form action="{{route('variations.update',$bakery_variation->id)}}" method="POST" class="form-example">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="key" value="{{$key}}">
                                        <input type="hidden" name="page" value="{{$page}}">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 form_div">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name..." value="{{$bakery_variation->name}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Category</label>
                                                        <select class="form-control select2" required name="category_id">
                                                            @foreach ($category as $item)
                                                            <option @if($item->id == $bakery_variation->category_id) {{'selected'}} @endif value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach   
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Value</label>
                                                        <input type="text" class="form-control" id="value" name="value" value="{{$bakery_variation->value}}" data-role="tagsinput" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this Variation?');"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
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
