@extends('app')

@section('content')
<div class="container" style="max-width: 600px; margin-top: 50px;">
    <h2 class="mb-4">Lista de Usuarios</h2>
    <p>Bienvenido a la página de usuarios. Aquí puedes ver información relevante sobre los usuarios registrados en el sistema.</p>
    <ul class="list-group">
        <li class="list-group-item">Usuario 1: usuario1@email.com</li>
        <li class="list-group-item">Usuario 2: usuario2@email.com</li>
        <li class="list-group-item">Usuario 3: usuario3@email.com</li>
    </ul>
</div>
@endsection
