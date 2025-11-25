<!DOCTYPE html>
<html lang="es">

@include('layouts.head')

<body>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('home.index') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">Plataforma Cursos</span>
                                </a>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Crear una cuenta</h5>
                                        <p class="text-center small">Complete los campos para registrarse</p>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('register') }}" class="row g-3" novalidate>
                                        @csrf

                                        <div class="col-12">
                                            <label class="form-label">Nombre completo</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                   class="form-control" required autofocus>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Correo electrónico</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                   class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" name="password"
                                                   class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Confirmar contraseña</label>
                                            <input type="password" name="password_confirmation"
                                                   class="form-control" required>
                                        </div>

                                        {{-- SELECT DINÁMICO DE ROLES --}}
                                        <div class="col-12">
                                            <label class="form-label">Rol</label>
                                            <select name="role_id" class="form-select" required>
                                                <option value="">Seleccione un rol</option>

                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                                        </div>

                                        <div class="col-12 text-center">
                                            <small>
                                                ¿Ya tienes cuenta?
                                                <a href="{{ route('login') }}">Inicia sesión aquí</a>
                                            </small>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    @include('layouts.footer')
    @include('layouts.scripts')
</body>

</html>
