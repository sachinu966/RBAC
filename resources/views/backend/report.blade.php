@extends('backend.app')

@section('content-area')
<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Manage Reports</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Start Report Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-end">
                            
                        </h5>
                    </div><!-- End Card Header -->

                    <div class="card-body">
                        <!-- Search/Filter Form -->
                        <div class="row gy-4 mb-4">
                            <div class="col-md-4">
                                <label for="report_type" class="form-label">Report Type</label>
                                <select name="report_type" id="report_type" class="form-control">
                                    <option value="">Select Report Type</option>
                                    <option value="sales">Sales Report</option>
                                    <option value="user">User Report</option>
                                    <option value="traffic">Traffic Report</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="date_range" class="form-label">Date Range</label>
                                <input type="text" name="date_range" id="date_range" class="form-control" placeholder="Select Date Range">
                            </div>

                            <div class="col-md-4">
                                <label for="search" class="form-label">Search Reports</label>
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search by Title">
                            </div>
                        </div>

                        <!-- Report Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dummy Data -->
                                    <tr>
                                        <td>Sales Report - January</td>
                                        <td>Sales</td>
                                        <td>2024-01-01</td>
                                        <td>
                                            <a href="" class="btn btn-info btn-sm">View</a>
                                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>User Activity Report - March</td>
                                        <td>User</td>
                                        <td>2024-03-10</td>
                                        <td>
                                            <a href="" class="btn btn-info btn-sm">View</a>
                                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Add more dummy data as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End Card Body -->
                </div>
            </div>
        </div>
        <!-- End Report Table -->
    </div>
</div>
@endsection
