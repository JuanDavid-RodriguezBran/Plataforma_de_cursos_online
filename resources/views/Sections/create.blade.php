@extends('layouts.app')
@section('content')
   <h1>New sections</h1>
   <form action="{{route('sections.store') }}"method="POST">
      @csrf
      <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name"/>
      </div>
      <div class="mb-3">
          <label class="form-label">Description</label>
          <input type="text" class="form-control" name="description"/>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
   </form>
@endsection
