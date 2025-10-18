@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Course Details</h1>
                    </div>

                    <div class="card-body">
                        <h2 class="card-title display-5 text-dark mb-4">{{ $course->title }}</h2>

                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Description:</label>
                            <p class="card-text">{{ $course->description ?? 'No description available' }}</p>
                        </div>

                        <div class="mb-4 border-top pt-3">
                            <label class="font-weight-bold text-secondary">ID:</label>
                            <p>{{ $course->course_id }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Section:</label>
                            <p>{{ $course->section ? $course->section->name : '—' }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Instructor:</label>
                            <p>{{ $course->user ? ($course->user->name ?? ($course->user->first_name . ' ' . $course->user->last_name)) : '—' }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Prerequisite:</label>
                            <p>{{ $course->prerequisite ? $course->prerequisite->title : '—' }}</p>
                        </div>

                        @if ($course->created_at)
                            <div class="mb-4">
                                <label class="font-weight-bold text-secondary">Created At:</label>
                                <p>{{ $course->created_at->format('M d, Y H:i:s') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('courses.edit', $course->course_id) }}" class="btn btn-warning">Edit Course</a>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

