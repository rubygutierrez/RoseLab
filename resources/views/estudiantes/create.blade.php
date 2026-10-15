@extends('layouts.app')

@section('title', 'Registrar estudiante')

@section('content')
<div class="mb-4">
    <h2 class="page-title">Registrar estudiante</h2>
    <p class="page-description">
        Registra a un estudiante para que pueda ingresar a RoseLab.
    </p>
</div>

<div class="panel" style="max-width: 750px; margin: auto;">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los siguientes datos:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('estudiantes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre completo</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name') }}"
                placeholder="Ej. María Pérez"
                required
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                value="{{ old('email') }}"
                placeholder="estudiante@correo.com"
                required
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                minlength="8"
                required
            >
            <small class="text-secondary">
                Debe tener al menos 8 caracteres.
            </small>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">
                Confirmar contraseña
            </label>
            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="form-control"
                minlength="8"
                required
            >
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-check me-2"></i>
                Guardar estudiante
            </button>

            <a href="{{ route('dashboard') }}"
               class="btn btn-outline-secondary">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
