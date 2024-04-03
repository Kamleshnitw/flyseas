@extends('backend.include.header')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row m-1">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create New User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-body p-0">
                                <div class="modal-body">
                                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                @foreach ($permission as $value)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h6>{{ $value->parent_name }}</h6>
                                                                </div>
                                                                <div class="card-body" style="height: 200px; overflow-x: hidden;">
                                                                    @php
                                                                        $parent_permissions = \Spatie\Permission\Models\Permission::where('parent_id', $value->parent_id)->get();
                                                                    @endphp
                                                                    @foreach ($parent_permissions as $parent_permission)
                                                                        <div class=" row col-md-12">
                                                                            <div class="col-md-9">
                                                                                {{ ucwords(str_replace('-', ' ', $parent_permission->name)) }}
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <div class="custom-control custom-switch">
                                                                                        <input type="checkbox" name="permission[]" value="{{ $parent_permission->id }}" class="custom-control-input" id="{{ $parent_permission->id }}">
                                                                                        <label class="custom-control-label" for="{{ $parent_permission->id }}"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
