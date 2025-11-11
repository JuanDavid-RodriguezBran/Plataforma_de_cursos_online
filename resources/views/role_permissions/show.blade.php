@extends('layouts.app')
@section('content')
     <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Role Permission Details</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Role:</label>
                            <p class="card-text">{{$rolePermission->role->name ?? 'N/A'}}</p>
                        </div>

                        <div class="mb-4 border-top pt-3">
                            <label class="font-weight-bold text-secondary">Permission:</label>
                            <p class="card-text">{{$rolePermission->permission->name ?? 'N/A'}}</p>
                        </div>

                        @if ($rolePermission->permission->descripcion)
                            <div class="mb-4 border-top pt-3">
                                <label class="font-weight-bold text-secondary">Permission Description:</label>
                                <p class="card-text">{{$rolePermission->permission->descripcion}}</p>
                            </div>
                        @endif

                        <div class="mb-4 border-top pt-3">
                            <label class="font-weight-bold text-secondary">Role ID:</label>
                            <p>{{$rolePermission->role_id}}</p>
                        </div>

                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Permission ID:</label>
                            <p>{{$rolePermission->permission_id}}</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{route('role_permissions.edit', [$rolePermission->role_id, $rolePermission->permission_id])}}" class="btn btn-warning">Edit Role Permission</a>

                        <a href="{{route('role_permissions.index')}}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
     </div>
@endsection

