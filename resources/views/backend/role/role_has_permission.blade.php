@extends('backend.app')

@section('content-area')
<div class="page-content">
    <div class="container-fluid">
        <!-- Start Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Role Permissions</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Permissions</li>
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

                    <form action="{{ route('roles.permissions.update') }}" method="POST">
                        @csrf
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
                        <div class="card-body">
                            <!-- Table to show Roles and Permissions -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <!-- Role Name -->
                                                <td>{{ $role->name }}</td>
                                                
                                                <!-- Permissions for each Role -->
                                                <td>
                                                    @foreach($permissions as $permission)
                                                        <div class="form-check">
                                                            <input 
                                                                type="checkbox" 
                                                                name="role_permissions[{{ $role->id }}][]" 
                                                                class="form-check-input" 
                                                                value="{{ $permission->id }}" 
                                                                {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                            <label class="form-check-label">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-xxl-12 col-md-12 mt-5">
                                <div>
                                    <button class="btn btn-primary rounded-pill">Update Permissions</button>
                                </div>
                            </div>
                        </div><!-- End Card Body -->
                    </form>
                </div>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>
@endsection
