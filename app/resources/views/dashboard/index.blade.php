@extends('app')

@section('content')
<div class="container text-center" style="margin-top: 50px;">
    <h2>Dashboard</h2>
    <p>Has iniciado sesión correctamente y tienes acceso completo.</p>

    <a href="{{ route('redirigir') }}" class="btn btn-primary mt-4">Ir según mi edad</a>
</div>
@endsection
