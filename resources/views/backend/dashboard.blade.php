@extends('backend.include.header')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-info">
                    <span class="info-box-icon"><i class="ion ion-bag"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">New Orders</span>
                    <h4 class="info-box-number">150</h4>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    70% Increase in 30 Days
                    </span>
                    </div>

                    </div>

                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-success">
                    <span class="info-box-icon"><i class="ion ion-stats-bars"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Bounce Rate</span>
                    <h4 class="info-box-number">53%</h4>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    70% Increase in 30 Days
                    </span>
                    </div>

                    </div>

                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-warning">
                    <span class="info-box-icon"><i class="ion ion-person-add"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">User Registrations</span>
                    <h4 class="info-box-number">44</h4>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    70% Increase in 30 Days
                    </span>
                    </div>

                    </div>

                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-danger">
                    <span class="info-box-icon"><i class="ion ion-pie-graph"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Unique Visitors</span>
                    <h4 class="info-box-number">65</h4>
                    <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                    70% Increase in 30 Days
                    </span>
                    </div>

                    </div>

                    </div>

                    </div>
            </div>
        </section>
    </div>
@endsection
