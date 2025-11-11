@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required class="form-control">
        </div>

        <div class="form-group">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember session</label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <hr>

    <div class="register-options">
        <h3>Register New User</h3>
        <div>
            <a href="{{ route('register.students') }}" class="btn btn-secondary">Register Students</a>
        </div>
        <div>
            <a href="{{ route('register.teachers') }}" class="btn btn-secondary">Register Teachers</a>
        </div>
    </div>
</div>
@endsection
