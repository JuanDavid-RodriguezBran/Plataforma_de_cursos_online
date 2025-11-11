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
                                        <h5 class="card-title text-center pb-0 fs-4">Restablecer contraseña</h5>
                                        <p class="text-center small">Ingrese su nueva contraseña para continuar</p>
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

                                    <form method="POST" action="{{ route('password.store') }}" class="row g-3">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <div class="col-12">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" id="email" name="email"
                                                   value="{{ old('email', $request->email) }}"
                                                   class="form-control" required autofocus>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Nueva contraseña</label>
                                            <input type="password" id="password" name="password"
                                                   class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                            <input type="password" id="password_confirmation"
                                                   name="password_confirmation" class="form-control" required>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Restablecer contraseña</button>
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
