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
                                    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                {!! Form::text('name', null, ['placeholder' => 'Enter Name', 'class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Email:</strong>
                                                {!! Form::text('email', null, ['placeholder' => 'Enter Email', 'class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Phone Number</strong>:</strong>
                                                {!! Form::number('phone', null, ['placeholder' => 'Enter Phone Number', 'class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Password:</strong>
                                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Confirm Password:</strong>
                                                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Role:</strong>
                                                {!! Form::select('roles', $roles, null, ['class' => 'form-control select2']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>City:</strong>
                                                <select name="city_id" class ="form-control select2" id="city_id">
                                                    <option value="">Select City</option>
                                                    @foreach ($citys as $city)
                                                        @if(!in_array($city->id, $assigned_city))
                                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Full Address:</strong>
                                                {!! Form::textarea('address', null, ['placeholder' => 'Enter Full Address', 'class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
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
