@extends('app')

@section('content')
<div class="container" style="max-width: 400px; margin-top: 50px;">
    <h2 class="mb-4 text-center">Ingresa tu edad</h2>
<form method="POST" action="{{ route('guardar.edad') }}">
    @csrf

        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad" min="0" max="120" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Continuar</button>
    </form>
</div>
@endsection
