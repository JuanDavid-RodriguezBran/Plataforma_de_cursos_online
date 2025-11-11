@extends('layouts.app')
@section('content')
   <h1>New Permission</h1>
   <form action="{{route('permissions.store') }}"method="POST">
      @csrf
      <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" name="name" required maxlength="100"/>
          @error('name')
              <div class="text-danger">{{$message}}</div>
          @enderror
      </div>
      <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="descripcion" rows="3"></textarea>
          @error('descripcion')
              <div class="text-danger">{{$message}}</div>
          @enderror
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{route('permissions.index')}}" class="btn btn-secondary">Cancel</a>
   </form>
@endsection

