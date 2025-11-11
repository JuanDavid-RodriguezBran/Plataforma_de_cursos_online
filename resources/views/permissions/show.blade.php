@extends('layouts.app')
@section('content')
     <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Permission Details</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title dispaly-5 text-dark mb-4">{{$permission->name}}</h2>

                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Description:</label>
                            <p class="card-text">{{$permission->descripcion ?? '(No description)'}}</p>
                        </div>

                        <div class="mb-4 border-top pt-3">
                            <label class="font-weight-bold text-secondary">ID:</label>
                            <p>{{$permission->permission_id}}</p>
                        </div>

                        @if ($permission->created_at)
                            <div class="mb-4">
                                <label class="font-weight-bold text-secondary">Created At:</label>
                                <p>{{$permission->created_at->format('M d, Y H:i:s')}}</p>
                            </div>
                        @endif

                        @if ($permission->updated_at)
                            <div class="mb-4">
                                <label class="font-weight-bold text-secondary">Updated At:</label>
                                <p>{{$permission->updated_at->format('M d, Y H:i:s')}}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{route('permissions.edit', $permission->permission_id)}}" class="btn btn-warning">Edit Permission</a>

                        <a href="{{route('permissions.index')}}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
     </div>
@endsection

