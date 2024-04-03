@extends('backend.include.header')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row m-1">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Vendor Banner</li>
                    </ol>
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
                            <h3 class="card-title">Vendor Banner</h3>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card-body table-responsive p-2">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Banners</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 0; @endphp
                                            @forelse ($list as $key=>$data)
                                                <tr>
                                                    <td class="text-center">{{++$i}}</td>
                                                    <td class="text-center">{{$data->banner_type}}</td>
                                                    <td class="text-center"><img src="{{asset('public/'.api_asset($data->banner))}}" style="height: 100px;width: 100px;"></td>
                                                    <td class="text-center">
                                                        @can('vendor-banner-delete')
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['vendor.banner.destroy', $data->id], 'style' => 'display:inline']) !!}
                                                                <button type="submit" class='btn btn-outline-danger btn-sm'><i class="fas fa-trash"></i></button>
                                                            {!! Form::close() !!}
                                                        @endcan
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
                            <div class="col-6">
                                <div class="card card-outline card-info">
                                    <div class="card-body p-0">
                                        <div class="modal-body">
                                            <form action="{{route('vendor.banner.store')}}" method="POST" class="form-example">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 form_div">
                                                            <div class="form-group">
                                                                <label for="banner_type">Type</label>
                                                                <select class="form-control" name="banner_type" id="banner_type" required>
                                                                    <option value="" selected disabled>Select Banner Type</option>
                                                                    <option value="Top">Top</option>
                                                                    <option value="Midd">Midd</option>
                                                                    <option value="Footer">Footer</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Banner</label>
                                                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                                    <div class="form-control file-amount">Select Banner</div>
                                                                    <input type="hidden" name="banner" class="selected-files">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                                                    </div>
                                                                </div>
                                                                <div class="file-preview box sm">
                                                                </div>
                                                                @if ($errors->has('banner'))
                                                                    <span class="text-danger">{{ $errors->first('banner') }}</span>
                                                                @endif
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection