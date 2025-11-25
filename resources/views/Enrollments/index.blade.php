@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1>Enrollments</h1>

    @if (\App\Helpers\RoleHelper::isAuthorized('Enrollments.createEnrollments'))
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">+ New Enrollment</a>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Course</th>
                <th>Enrolled At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->enrollment_id }}</td>

                    <td>{{ $enrollment->user ? $enrollment->user->name : '(Unknown)' }}</td>

                    <td>{{ $enrollment->course ? $enrollment->course->title : '(None)' }}</td>

                    <td>{{ $enrollment->enrolled_at ?? '—' }}</td>

                    <td>
                        @if ($enrollment->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>

                    <td style="width: 180px;">

                        <a href="{{ route('enrollments.show', $enrollment->enrollment_id) }}"
                            class="btn btn-info btn-sm">View</a>

                        @if (\App\Helpers\RoleHelper::isAuthorized('Enrollments.updateEnrollments'))
                            <form action="{{ route('enrollments.updateStatus', $enrollment->enrollment_id) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="status" value="cancelled">

                                <button class="btn btn-warning btn-sm">
                                    Cancel
                                </button>
                            </form>
                        @endif

                        @if (\App\Helpers\RoleHelper::isAuthorized('Enrollments.deleteEnrollments'))
                            <form action="{{ route('enrollments.destroy', $enrollment->enrollment_id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirm('Delete this enrollment permanently?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
