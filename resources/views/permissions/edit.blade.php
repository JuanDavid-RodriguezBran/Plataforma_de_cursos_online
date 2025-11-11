@extends('layouts.app')
@section('content')
    <h1>Edit Permission: {{$permission->name}}</h1>

    <form action="{{route('permissions.update', $permission)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name', $permission->name)}}" required maxlength="100"/>
            @error('name')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="descripcion" rows="3">{{old('descripcion', $permission->descripcion)}}</textarea>
            @error('descripcion')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{route('permissions.index')}}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

