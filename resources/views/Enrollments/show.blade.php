@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Enrollment Details</h1>
                </div>

                <div class="card-body">

                    <div class="mb-4">
                        <label class="font-weight-bold text-secondary">Enrollment ID:</label>
                        <p>{{ $enrollment->enrollment_id }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-weight-bold text-secondary">Student:</label>
                        <p>{{ $enrollment->user ? $enrollment->user->name : '—' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-weight-bold text-secondary">Course:</label>
                        <p>{{ $enrollment->course ? $enrollment->course->title : '—' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-weight-bold text-secondary">Status:</label>
                        <p>
                            @if($enrollment->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-4">
                        <label class="font-weight-bold text-secondary">Enrolled At:</label>
                        <p>{{ $enrollment->enrolled_at }}</p>
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('enrollments.edit', $enrollment->enrollment_id) }}"
                       class="btn btn-warning">Cancel Enrollment</a>

                    <a href="{{ route('enrollments.index') }}"
                       class="btn btn-secondary">Back to List</a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
