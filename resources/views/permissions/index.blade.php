@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <h1>Permissions</h1>

    <a href="{{route('permissions.create')}}" class="btn btn-primary">+ New Permission</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($permissions as $permission )
                 <tr>
                    <td>{{$permission->permission_id}}</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->descripcion ?? '(No description)'}}</td>

                    <td style="width: 150px;">
                        <a href="{{ route('permissions.show', $permission->permission_id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('permissions.edit', $permission->permission_id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{route('permissions.destroy', $permission->permission_id)}}" method="POST" style="display: inline;"
                              onsubmit="return confirm('Are you sure you want to delete this permission?');">
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

