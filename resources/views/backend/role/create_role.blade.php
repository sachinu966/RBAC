@extends('backend.app')

@section('content-area')
<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Role Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">
                                {{ isset($editRole) ? 'Update Role' : 'Add New Role' }}
                            </li>
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
                            <a href="{{ route('roles.index') }}">
                                <button class="btn btn-secondary rounded-pill">Back</button>
                            </a>
                        </h5>
                    </div><!-- End Card Header -->

                    <form 
                        action="{{ isset($editRole) ? route('roles.update', Crypt::encrypt($editRole->id)) : route('roles.store') }}" 
                        method="POST" 
                        enctype="multipart/form-data">
                        
                        @csrf
                        @isset($editRole)
                            @method('PATCH')<div class="row gy-4">
    <div class="col-md-12">
        <label for="logs" class="form-label">Logs</label>
        <textarea 
            class="form-control" 
            name="logs" 
            id="logs" 
            rows="5" 
            placeholder="Enter Logs">{{ isset($editRole) ? $editRole->logs : '' }}</textarea>
    </div>
</div>
                        @endisset

                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Display Custom Error -->
                                @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                                <!-- Role Name Input -->
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <label for="role_name" class="form-label">Role Name</label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            class="form-control" 
                                            id="role_name" 
                                            value="{{ isset($editRole) ? $editRole->name : '' }}" 
                                            placeholder="Enter Role Name" 
                                            required>
                                    </div>

                                    <!-- Description Input -->
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea 
                                            class="form-control" 
                                            name="description" 
                                            id="description" 
                                            rows="5" 
                                            placeholder="Enter Description">{{ isset($editRole) ? $editRole->description : '' }}</textarea>
                                    </div>
                                </div>
                                   <!-- Submit Button -->
                            <div class="col-xxl-12 col-md-12 mt-5">
                                <div>
                                    <div id="formError" class="error-message text-danger"></div>
                                    <button class="btn btn-primary rounded-pill">
                                        {{ isset($editRole) ? 'Update' : 'Submit' }}
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
