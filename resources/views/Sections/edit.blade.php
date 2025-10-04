@extends('layouts.app')
@section('content')
    <h1>Edit Section:{{$section->name}}</h1>

    <form action="{{route('sections.update', $section)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name', $section->name)}}"/>
            @error('name')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" class="form-control" name="description" value="{{old('description', $section->description)}}"/>
            @error('description')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{route('sections.index')}}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
