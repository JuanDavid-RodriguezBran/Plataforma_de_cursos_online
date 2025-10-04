@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <h1>Sections</h1>

    <a href="{{route('sections.create')}}" class="btn btn-primary">+ New Section</a>
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
            @foreach ($sections as $section )
                 <tr>
                    <td>{{$section->id}}</td>
                    <td>{{$section->name}}</td>
                    <td>{{$section->description}}</td>

                    <td style="width: 150px;">
                        <a href="{{ route('sections.edit', $section) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{route('sections.destroy', $section)}}" method="POST" style="display: inline;"
                              onsubmit="return confirm('Are you sure you want to delete this section?');">
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
