@extends('layouts.app')
@section('content')
     <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Section Details</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title dispaly-5 text-dark mb-4">{{$section->name}}</h2>

                        <div class="mb-4">
                            <label class="font-weight-bold text-secondary">Description:</label>
                            <p class="card-text">{{$section->description}}</p>
                        </div>

                        <div class="mb-4 border-top pt-3">
                            <label class="font-weight-bold text-secondary">ID:</label>
                            <p>{{$section->id}}</p>
                        </div>

                        @if ($section->created_at)
                            <div class="mb-4">
                                <label class="font-weight-bold text-secondary">Created At:</label>
                                <p>{{$section->created_at->format('M d, Y H:i:s')}}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{route('sections.edit', $section->id)}}" class="btn btn-warning">Edit Section</a>

                        <a href="{{route('sections.index')}}" class="btn btn-warning">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
     </div>
@endsection
