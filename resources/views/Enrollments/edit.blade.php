@extends('layouts.app')

@section('content')
    <h1>Update Enrollment Status</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('enrollments.updateStatus', $enrollment->enrollment_id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="alert alert-warning">
            <strong>Note:</strong> You are modifying the status of this enrollment.
        </div>

        <div class="mb-3">
            <label class="form-label">Student</label>
            <input type="text" class="form-control"
                   value="{{ $enrollment->user->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Course</label>
            <input type="text" class="form-control"
                   value="{{ $enrollment->course->title }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="active" {{ $enrollment->status == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="cancelled" {{ $enrollment->status == 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Status</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back</a>
    </form>

@endsection

