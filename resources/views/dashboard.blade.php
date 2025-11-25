@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Inicio</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">

        {{-- ============================
             DASHBOARD ADMINISTRADOR
        ============================= --}}
        @if ($role === 'Administrador')

            @include('dashboard.widgets.admin', ['data' => $data])

        @endif



        {{-- ============================
              DASHBOARD PROFESOR
        ============================= --}}
        @if ($role === 'Profesor')

            @include('dashboard.widgets.teacher', ['data' => $data])

        @endif



        {{-- ============================
              DASHBOARD ESTUDIANTE
        ============================= --}}
        @if ($role === 'Estudiante')

            @include('dashboard.widgets.student', ['data' => $data])

        @endif

    </div>
</section>
@endsection
