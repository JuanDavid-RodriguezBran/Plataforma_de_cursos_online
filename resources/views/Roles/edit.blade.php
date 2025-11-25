@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Editar Rol</li>
            </ol>
        </nav>
    </div>

    <section class="section">

        {{-- Edit Role --}}
        <div class="card mt-3">
            <div class="card-header">
                <h3>Editar Rol</h3>
            </div>

            <div class="card-body mt-3">
                <form action="{{ route('roles.update') }}" method="POST" class="row g-3" id="frmEdit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <input type="hidden" name="permissions" id="permissions">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" value="{{ $role->name }}"
                                    required>
                                <label>Nombre</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Permissions --}}
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Permisos</h3>

                <div class="row">
                    @foreach ($modules as $key => $module)
                        <div class="col-md-3 mt-3">
                            <h5>{{ $key }}</h5>

                            @foreach ($module as $item)
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input permission"
                                        data-permission-id="{{ $item->id }}" id="permission_{{ $item->id }}"
                                        {{ $item->selected ? 'checked' : '' }}>
                                    <label for="permission_{{ $item->id }}" class="form-check-label">
                                        {{ $item->description }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary" form="frmEdit">Actualizar</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // CORRECCIÓN: generar JSON antes del submit
            $('#frmEdit').on('submit', function() {
                let ids = [];

                $('.permission:checked').each(function() {
                    ids.push($(this).data('permission-id'));
                });

                $('#permissions').val(JSON.stringify(ids));
            });

        });
    </script>
@endpush
