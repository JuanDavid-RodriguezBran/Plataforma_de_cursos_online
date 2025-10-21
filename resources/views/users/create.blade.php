@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Usuario</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select class="form-select" id="role" name="role" required>
                <option value="">Selecciona un rol</option>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Estudiante</option>
                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Profesor</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
        @if(session('error_detail'))
    <div class="alert alert-warning">
        <strong>Detalle técnico:</strong> {{ session('error_detail') }}
    </div>
@endif
    
    
    </form>
</div>
@endsection
