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

        <!-- Columna izquierda -->
        <div class="col-lg-8">
            <div class="row">

                <!-- Tarjeta de Usuarios -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card">
                        <div class="card-body">
                            <h5 class="card-title">Usuarios registrados</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>245</h6>
                                    <span class="text-success small pt-1 fw-bold">+8%</span>
                                    <span class="text-muted small pt-2 ps-1">este mes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Cursos -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card">
                        <div class="card-body">
                            <h5 class="card-title">Cursos disponibles</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-journal-bookmark"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>12</h6>
                                    <span class="text-success small pt-1 fw-bold">+2</span>
                                    <span class="text-muted small pt-2 ps-1">nuevos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Secciones -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card">
                        <div class="card-body">
                            <h5 class="card-title">Secciones activas</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-grid"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>8</h6>
                                    <span class="text-danger small pt-1 fw-bold">-1</span>
                                    <span class="text-muted small pt-2 ps-1">última semana</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End row -->
        </div><!-- End Left -->

        <!-- Columna derecha -->
        <div class="col-lg-4">

            <!-- Actividad reciente -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Actividad reciente</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-check-circle text-success me-2"></i> Nuevo usuario registrado
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-pencil text-warning me-2"></i> Se actualizó un curso
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-trash text-danger me-2"></i> Se eliminó una sección
                        </li>
                    </ul>
                </div>
            </div>

        </div><!-- End Right -->

    </div>
</section>

@endsection

