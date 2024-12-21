@extends('backend.app')

@section('content-area')
<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">User Profile</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Start Profile Details -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-end">
                            <a href="{{ route('users.edit', Crypt::encrypt(Auth::user()->id)) }}">
                                <button class="btn btn-secondary rounded-pill">Edit Profile</button>
                            </a>
                        </h5>
                    </div><!-- End Card Header -->

                    <div class="card-body">
                        <!-- Display User Info -->
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label"><strong>Name</strong></label>
                                <p>{{ Auth::user()->name }}</p>
                            </div>

                            <div class="col-md-12">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <p>{{ Auth::user()->email }}</p>
                            </div>

                            <div class="col-md-12">
                                <label for="role" class="form-label"><strong>Role</strong></label>
                                <p>{{ Auth::user()->roles[0]->name }}</p>
                            </div>
                        </div>

                        <!-- Change Password Link -->
                        <div class="mt-3">
                            <a href="" class="btn btn-warning rounded-pill">Change Password</a>
                        </div>
                    </div><!-- End Card Body -->
                </div>
            </div>
        </div>
        <!-- End Profile Details -->
    </div>
</div>
@endsection
