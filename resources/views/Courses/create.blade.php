@extends('layouts.app')

@section('content')
   <h1>New Course</h1>

   <form action="{{ route('courses.store') }}" method="POST">
      @csrf

      <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" class="form-control" name="title" required>
      </div>

      <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="3"></textarea>
      </div>

      <div class="mb-3">
          <label class="form-label">Section</label>
          <select class="form-select" name="section_id">
              <option value="">-- Select Section --</option>
              @foreach ($sections as $section)
                  <option value="{{ $section->id }}">{{ $section->name }}</option>
              @endforeach
          </select>
      </div>

      <div class="mb-3">
          <label class="form-label">Creator (User)</label>
          <select class="form-select" name="user_id">
              <option value="">-- Select User --</option>
              @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name ?? ($user->first_name . ' ' . $user->last_name) }}</option>
              @endforeach
          </select>
      </div>

      <div class="mb-3">
          <label class="form-label">Prerequisite Course</label>
          <select class="form-select" name="prerequisite_id">
              <option value="">-- None --</option>
              @foreach ($courses as $course)
                  <option value="{{ $course->course_id }}">{{ $course->title }}</option>
              @endforeach
          </select>
      </div>

      <button type="submit" class="btn btn-primary">Save</button>
   </form>
@endsection
