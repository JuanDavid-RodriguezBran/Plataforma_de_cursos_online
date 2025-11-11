@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <h1>Role Permissions</h1>

    <a href="{{route('role_permissions.create')}}" class="btn btn-primary">+ New Role Permission</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Role</th>
                <th>Permission</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($rolePermissions as $rolePermission )
                 <tr>
                    <td>{{$rolePermission->role->name ?? 'N/A'}}</td>
                    <td>{{$rolePermission->permission->name ?? 'N/A'}}</td>

                    <td style="width: 200px;">
                        <a href="{{ route('role_permissions.show', [$rolePermission->role_id, $rolePermission->permission_id]) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('role_permissions.edit', [$rolePermission->role_id, $rolePermission->permission_id]) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{route('role_permissions.destroy', [$rolePermission->role_id, $rolePermission->permission_id])}}" method="POST" style="display: inline;"
                              onsubmit="return confirm('Are you sure you want to delete this role permission?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                 </tr>

            @endforeach
        </tbody>
    </table>
@endsection

