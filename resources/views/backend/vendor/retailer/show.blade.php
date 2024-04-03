@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Manage Retailers</li>
                            <li class="breadcrumb-item active">Show Retailers</li>
                        </ol>
                    </div>
                    {{-- <div class="col-sm-6">
                        @can('vendor-product-create')
                            <a href="{{route('vendor.products.create').'?key='.$search.'&page='.$list->currentPage()}}" class="btn btn-success float-right"> Add Product <i class="fas fa-plus"></i></a>
                        @endcan
                    </div> --}}
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Retailer Wallet</h3>
                                <div class="card-tools">
                                    <h3>
                                        Balance: <b>{{$data->wallet_balance}}</b> 
                                    </h3>
                                </div>
                                <div class="card-body table-responsive p-2">
                                    {!! Form::open(['method' => 'PATCH','route' => ['vendor.retailers.update', $data->id]]) !!}
                                        <div class="row">
                                            <div class="col-9">
                                                <input type="number" name="amount" class="form-control" placeholder="Enter Amounts" required>
                                            </div>
                                            <div class="col-3">
                                                <button type="submit" class="btn btn-primary">Add Amount</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                    <table class="table table-bordered table-striped mt-4">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=0; @endphp
                                            @forelse ($data->walletHistory as $histroy)
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>
                                                    @if ($histroy->type=="credit")
                                                        <span class="badge badge-success">{{ucfirst($histroy->type)}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ucfirst($histroy->type)}}</span>
                                                    @endif
                                                </td>
                                                <td> {{$histroy->amount}} </td>
                                            </tr>
                                            @empty
                                                <tr class="footable-empty">
                                                    <td colspan="11">
                                                    <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Retailer Address</h3>
                                <div class="card-tools">
                                </div>
                                    <div class="card-body table-responsive p-2">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0; @endphp
                                                @forelse ($data->address as $address)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>
                                                        {{$address->address}} <br>
                                                        {{$address->city}}, {{$address->state}}, {{$address->country}} - {{$address->pincode}}
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr class="footable-empty">
                                                        <td colspan="11">
                                                        <center style="padding: 70px;"><i class="far fa-frown" style="font-size: 100px;"></i><br><h2>Nothing Found</h2></center>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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
