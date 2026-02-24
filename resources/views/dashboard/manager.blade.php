@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')
<div class="row">
    <!-- Team Clients -->
    <div class="col-lg-4 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>45</h3>
                <p>Team Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <a href="#" class="small-box-footer">View Team Clients <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- Team Leads -->
    <div class="col-lg-4 col-12">
        <div class="small-box bg-purple" style="background-color: #6f42c1 !important; color: white;">
            <div class="inner">
                <h3>156</h3>
                <p>Team Leads</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn" style="color: rgba(255,255,255,0.4)"></i>
            </div>
            <a href="#" class="small-box-footer" style="color: white !important;">View Team Leads <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- Pending Tasks -->
    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>12</h3>
                <p>Pending Team Tasks</p>
            </div>
            <div class="icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <a href="#" class="small-box-footer">Review Tasks <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-indigo card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Lead Conversion Chart</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="managerChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection