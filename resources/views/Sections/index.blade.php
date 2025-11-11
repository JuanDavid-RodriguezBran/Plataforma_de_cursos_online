@extends('layouts.app')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <h1>Sections</h1>

    @if(\App\Helpers\RoleHelper::isAuthorized('Courses.createCourses'))
    <a href="{{route('sections.create')}}" class="btn btn-primary">+ New Section</a>
    @endif
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
                    <td>{{$section->section_id}}</td>
                    <td>{{$section->name}}</td>
                    <td>{{$section->description}}</td>

                    <td style="width: 150px;">
                        @if(\App\Helpers\RoleHelper::isAuthorized('Courses.updateCourses'))
                        <a href="{{ route('sections.edit', $section->section_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif

                        @if(\App\Helpers\RoleHelper::isAuthorized('Courses.deleteCourses'))
                        <form action="{{route('sections.destroy', $section->section_id)}}" method="POST" style="display: inline;"
                              onsubmit="return confirm('Are you sure you want to delete this section?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @endif
                    </td>
                 </tr>

            @endforeach
        </tbody>
    </table>
@endsection
