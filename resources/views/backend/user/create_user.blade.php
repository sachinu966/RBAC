@extends('backend.app')

@section('content-area')
<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">User Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ isset($editUser) ? 'Update User' : 'Add New User' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Start Form -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-end">
                            <a href="{{ route('users.index') }}">
                                <button class="btn btn-secondary rounded-pill">Back</button>
                            </a>
                        </h5>
                    </div><!-- End Card Header -->

                    <form 
                        action="{{ isset($editUser) ? route('users.update', Crypt::encrypt($editUser->id)) : route('users.store') }}" 
                        method="POST">
                        
                        @csrf
                        @isset($editUser)
                            @method('PATCH')
                        @endisset

                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Display Custom Error -->
                                @if (session('custom_error'))
                                    <div class="alert alert-danger">
                                        {{ session('custom_error') }}
                                    </div>
                                @endif

                                <!-- User Name Input -->
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Name</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            class="form-control" 
                                            id="name" 
                                            value="{{ isset($editUser) ? $editUser->name : '' }}" 
                                            placeholder="Enter Name" 
                                            required>
                                    </div>

                                    <!-- Email Input -->
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            class="form-control" 
                                            id="email" 
                                            value="{{ isset($editUser) ? $editUser->email : '' }}" 
                                            placeholder="Enter Email" 
                                            required>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="col-md-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            class="form-control" 
                                            id="password" 
                                            placeholder="Enter Password" 
                                            required>
                                    </div>

                                    <!-- Confirm Password Input -->
                                    <div class="col-md-12">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            class="form-control" 
                                            id="password_confirmation" 
                                            placeholder="Confirm Password" 
                                            required>
                                    </div>

                                    <!-- Role Selection -->
                                    <div class="col-md-12">
                                        <label for="role_id" class="form-label">Role</label>
                                        <select name="role_id" id="role_id" class="form-control" required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{ isset($editUser) && $editUser->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-xxl-12 col-md-12 mt-5">
                                    <div>
                                        <div id="formError" class="error-message text-danger"></div>
                                        <button class="btn btn-primary rounded-pill">
                                            {{ isset($editUser) ? 'Update User' : 'Create User' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>
@endsection
