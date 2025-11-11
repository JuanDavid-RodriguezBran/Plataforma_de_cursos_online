@extends('layouts.app')
@section('content')
    <h1>Edit Role Permission</h1>

    <form action="{{route('role_permissions.update', [$rolePermission->role_id, $rolePermission->permission_id])}}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role_id" required>
                <option value="">-- Select Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{old('role_id', $rolePermission->role_id) == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Permission</label>
            <select class="form-select" name="permission_id" required>
                <option value="">-- Select Permission --</option>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->permission_id }}" {{old('permission_id', $rolePermission->permission_id) == $permission->permission_id ? 'selected' : ''}}>{{ $permission->name }}</option>
                @endforeach
            </select>
            @error('permission_id')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{route('role_permissions.index')}}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

