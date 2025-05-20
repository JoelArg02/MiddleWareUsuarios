@extends('app')

@section('content')
<div class="container" style="max-width: 400px; margin-top: 50px;">
    <h2 class="mb-4">Completar Perfil</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('perfil.guardar') }}">
        @csrf
        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad" required min="1" max="120">
        </div>
        <button type="submit" class="btn btn-primary w-100">Guardar</button>
    </form>
</div>
@endsection
