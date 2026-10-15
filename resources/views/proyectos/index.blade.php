@extends('layouts.app')

@section('title', 'Proyectos')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Proyectos</h2>
        <p class="page-description">
            Organiza y consulta los proyectos del laboratorio.
        </p>
    </div>

    <div class="panel text-center py-5">
        <div class="stat-icon mx-auto mb-3">
            <i class="bi bi-kanban"></i>
        </div>

        <h5 class="fw-semibold mb-2">Bienvenido a Proyectos</h5>

        <p class="text-secondary mb-4">
            Aquí podrás organizar los proyectos y consultar su información.
            Esta sección está preparada para agregar funciones próximamente.
        </p>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            <i class="bi bi-house me-2"></i>
            Volver al inicio
        </a>
    </div>
@endsection