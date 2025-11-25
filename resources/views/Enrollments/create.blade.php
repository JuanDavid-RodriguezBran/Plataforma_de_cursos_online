@extends('layouts.app')

@section('content')

    <h1>New Enrollment</h1>

    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Student</label>
            <select class="form-select" name="user_id" required>
                <option value="">-- Select Student --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Course</label>
            <select class="form-select" name="course_id" required>
                <option value="">-- Select Course --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->course_id }}">
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Enrollment</button>
    </form>

@endsection
