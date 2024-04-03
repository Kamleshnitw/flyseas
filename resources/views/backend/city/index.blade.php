@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">City List</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-6">
                        <a href="{{route('city.create').'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-success float-right"> Add City <i class="fas fa-plus"></i></a>
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">City List</h3>
                                <div class="card-tools">
                                    <form action="{{route('city.index')}}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="key" value="{{$search}}" class="form-control float-right" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body table-responsive p-2">
                                        @include('backend.city.table')
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card card-outline card-info">
                                        <div class="card-body p-0">
                                            <div class="modal-body">
                                                @if (isset($edit_city))
                                                    <form action="{{route('city.update', $edit_city->id)}}" method="POST" class="form-example">
                                                        @method('PUT')
                                                @else 
                                                    <form action="{{route('city.store')}}" method="POST" class="form-example">
                                                @endif
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 form_div">
                                                                <div class="form-group">
                                                                    <label for="name">City Name</label>
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter City Name..." value="@isset($edit_city){{$edit_city->name}}@endisset" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-outline-success mt-1 mb-1" onclick="return confirm('Are you sure you want to Save this city?');"><i class="fa fa-check" aria-hidden="true"></i> SAVE</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
