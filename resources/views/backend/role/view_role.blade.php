@extends('backend.app')
@section('content-area')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Roles List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">View Roles</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0 text-end"><a href="{{route('roles.create')}}"><button class="btn btn-secondary rounded-pill ">Add New Role</button></a></h5>
                                </div>
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
                                <div class="card-body table-responsive">
                                    <table id="buttons-datatables" class="display table table-bordered " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.no</th>
                                                <th>Name</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $data)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>

<td> {{ $data->name?? '' }}</td>
                                       
                                                <td>{{$data->created_at->format('d-M-Y')??'' }}</td>                                          
                                                <td>
                                                <div class="d-flex gap-2">
                                                @php $cid=Crypt::encrypt($data->id); @endphp

                                                                <div class="edit">
                                                                    <a href="{{route('roles.edit',$cid)}}"><button class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Edit</button></a>
                                                                </div>
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="event.preventDefault();
                                    document.getElementById('delete-form-{{ $cid }}').submit();" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                                                </div>
                                                            </div>
                                                </td>
                                                <form id="delete-form-{{ $cid }}" action="{{ route('roles.destroy',$cid) }}" method="post" style="display: none;">
                @method('DELETE')
               @csrf
           </form>
                                            </tr>
                                           
                     
                                            @endforeach
                                            
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
@endsection