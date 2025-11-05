@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1>Courses</h1>

    <a href="{{ route('courses.create') }}" class="btn btn-primary">+ New Course</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Section</th>
                <th>Instructor</th>
                <th>Prerequisite</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->course_id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->section ? $course->section->name : '(None))' }}</td>
                    <td>{{ $course->user ? ($course->user->name ?? ($course->user->first_name . ' ' . $course->user->last_name)) : '(None)' }}</td>
                    <td>{{ $course->prerequisite ? $course->prerequisite->title : '(No prerequisite)' }}</td>

                    <td style="width: 150px;">
                        <a href="{{ route('courses.edit', $course->course_id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('courses.destroy', $course->course_id) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this course?');">
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
