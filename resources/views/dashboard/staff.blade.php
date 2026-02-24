@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<div class="row">
    <!-- My Leads -->
    <div class="col-lg-6 col-12">
        <div class="small-box bg-maroon" style="background-color: #d81b60 !important; color: white;">
            <div class="inner">
                <h3>15</h3>
                <p>Assigned Leads</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn" style="color: rgba(255,255,255,0.4)"></i>
            </div>
            <a href="#" class="small-box-footer" style="color: white !important;">Manage My Leads <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- My Tasks -->
    <div class="col-lg-6 col-12">
        <div class="small-box bg-navy" style="background-color: #001f3f !important; color: white;">
            <div class="inner">
                <h3>8</h3>
                <p>Pending Tasks</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle" style="color: rgba(255,255,255,0.4)"></i>
            </div>
            <a href="#" class="small-box-footer" style="color: white !important;">View My Tasks <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title"><i class="fas fa-clipboard-list mr-1"></i> Today's Schedule</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">T-124</a></td>
                                <td>Follow up with Client X</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td><span class="badge badge-danger">High</span></td>
                            </tr>
                            <tr>
                                <td><a href="#">T-125</a></td>
                                <td>Update Lead Status</td>
                                <td><span class="badge badge-success">On Progress</span></td>
                                <td><span class="badge badge-info">Medium</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Create New Task</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Tasks</a>
            </div>
        </div>
    </div>
</div>
@endsection