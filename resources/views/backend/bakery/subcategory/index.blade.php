@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Bakery Sub Category List</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        @can('bakery-category-create')
                            <a href="{{route('subcategories.create').'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-success float-right"> Add Sub Category <i class="fas fa-plus"></i></a>
                        @endcan
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Bakery Sub Category List</h3>
                                <div class="card-tools">
                                    <form action="{{route('subcategories.index')}}">
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
                            <div class="card-body table-responsive p-2">
                                @include('backend.bakery.subcategory.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
