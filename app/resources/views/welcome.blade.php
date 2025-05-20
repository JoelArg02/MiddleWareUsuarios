@extends('app')

@section('content')
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
            <div class="text-center mb-4">
                <img src="https://laravel.com/img/logomark.min.svg" alt="App Logo" width="80" class="mb-3">
                <h1 class="display-5 fw-bold">¡Bienvenido!</h1>
                <p class="lead">Explora las increíbles funciones de nuestra aplicación.</p>
            </div>

            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item">✔️ Interfaz moderna y amigable</li>
                <li class="list-group-item">✔️ Registro y acceso seguro</li>
                <li class="list-group-item">✔️ Soporte y documentación</li>
            </ul>

            <div class="d-flex flex-column gap-2">
                <a href="{{ route('login') }}" class="btn btn-primary w-100">Iniciar sesión</a>
                <a href="{{ route('admin') }}" class="btn btn-outline-secondary w-100">Admin</a>
                <a href="{{ route('user') }}" class="btn btn-outline-secondary w-100">User</a>
                <a href="{{ route('ingresar.edad') }}" class="btn btn-warning w-100">Ingresar Edad</a>
            </div>
        </div>
    </div>
@endsection
