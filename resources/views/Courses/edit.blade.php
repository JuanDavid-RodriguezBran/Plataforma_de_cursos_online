@extends('layouts.app')

@section('content')
    <h1>Edit Course: {{ $course->title }}</h1>

    <form action="{{ route('courses.update', $course->course_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $course->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description', $course->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Section</label>
            <select class="form-select" name="section_id">
                <option value="">-- Select Section --</option>
                @foreach ($sections as $section)
                    <option value="{{ $section->section_id }}"
                        {{ old('section_id', $course->section_id) == $section->section_id ? 'selected' : '' }}>
                        {{ $section->name }}
                    </option>
                @endforeach
            </select>
            @error('section_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Creator (User)</label>
            <select class="form-select" name="user_id">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('user_id', $course->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name ?? ($user->first_name . ' ' . $user->last_name) }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Prerequisite Course</label>
            <select class="form-select" name="prerequisite_id">
                <option value="">-- None --</option>
                @foreach ($courses as $item)
                    <option value="{{ $item->course_id }}"
                        {{ old('prerequisite_id', $course->prerequisite_id) == $item->course_id ? 'selected' : '' }}>
                        {{ $item->title }}
                    </option>
                @endforeach
            </select>
            @error('prerequisite_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
