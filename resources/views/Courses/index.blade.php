@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1>Courses</h1>

    {{-- Botón para crear curso --}}
    @if(\App\Helpers\RoleHelper::isAuthorized('Courses.createCourses'))
        <a href="{{ route('courses.create') }}" class="btn btn-primary">+ New Course</a>
    @endif

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
                @php
                    $isStudent = auth()->check() && auth()->user()->role_id == 3;
                    $alreadyEnrolled = auth()->check()
                        ? auth()->user()->enrollments()->where('course_id', $course->course_id)->exists()
                        : false;
                @endphp

                <tr>
                    <td>{{ $course->course_id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->section ? $course->section->name : '(None)' }}</td>
                    <td>{{ $course->user ? $course->user->name : '(None)' }}</td>
                    <td>{{ $course->prerequisite ? $course->prerequisite->title : '(No prerequisite)' }}</td>

                    <td style="width: 200px;">

                        {{-- Enroll button (solo estudiante) --}}
                        @if($isStudent)
                            @if(!$alreadyEnrolled)
                                <form action="{{ route('courses.enroll', $course->course_id) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Enroll</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>Enrolled</button>
                            @endif
                        @endif

                        {{-- Edit --}}
                        @if(\App\Helpers\RoleHelper::isAuthorized('Courses.updateCourses'))
                            <a href="{{ route('courses.edit', $course->course_id) }}"
                               class="btn btn-warning btn-sm">Edit</a>
                        @endif

                        {{-- Delete --}}
                        @if(\App\Helpers\RoleHelper::isAuthorized('Courses.deleteCourses'))
                            <form action="{{ route('courses.destroy', $course->course_id) }}"
                                  method="POST" style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this course?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif

                        {{-- Show (ver detalles) --}}
                        <a href="{{ route('courses.show', $course->course_id) }}"
                           class="btn btn-info btn-sm">View</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

