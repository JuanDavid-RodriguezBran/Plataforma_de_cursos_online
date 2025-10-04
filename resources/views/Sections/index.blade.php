@extends('layouts.app')
@section('content')
    <h1>Sections</h1>

    <a href="{{route('sections.create')}}" class="btn btn-primary">+ New Section</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sections as $section )
                 <tr>
                    <td>{{$section->id}}</td>
                    <td>{{$section->name}}</td>
                    <td>{{$section->description}}</td>
                 </tr>

            @endforeach
        </tbody>
    </table>
@endsection
