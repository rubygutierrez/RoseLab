@extends('layouts.app')

@section('title', 'Panel del encargado')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Panel de control</h2>
        <p class="page-description mb-0">
            Bienvenido a RoseLab. Aquí puedes consultar el resumen del laboratorio.
        </p>
    </div>

    {{-- Tarjetas de resumen --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Total de equipos</span>
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>

                <div class="stat-number">{{ $totalEquipos ?? 0 }}</div>
                <small class="text-secondary">Equipos registrados</small>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Equipos disponibles</span>
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>

                <div class="stat-number">{{ $equiposDisponibles ?? 0 }}</div>
                <small class="text-secondary">Listos para préstamo</small>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Préstamos activos</span>
                    <div class="stat-icon">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                </div>

                <div class="stat-number">{{ $prestamosActivos ?? 0 }}</div>
                <small class="text-secondary">Pendientes de devolución</small>
            </div>
        </div>
    </div>

    {{-- Accesos principales --}}
    <div class="row g-4">

        {{-- Registrar estudiantes --}}
        <div class="col-12 col-lg-6">
            <div class="panel h-100">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>

                    <div>
                        <h5 class="fw-semibold mb-1">Registrar estudiantes</h5>
                        <p class="text-secondary mb-0">
                            Incorpora estudiantes al sistema para que puedan
                            ingresar y solicitar préstamos de equipos.
                        </p>
                    </div>
                </div>

                <div class="rounded-3 p-3 mb-3"
                     style="background: #faf6fa; border: 1px solid #ebe5ea;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-person-badge" style="color: #79536f;"></i>
                        <span class="small text-secondary">Administración de usuarios</span>
                    </div>

                    <p class="small mb-0">
                        Podrás registrar el nombre, correo y contraseña de cada
                        estudiante, asignándole el rol correspondiente.
                    </p>
                </div>

                <a href="{{ route('estudiantes.create') }}"
                   class="btn btn-primary w-100">
                    <i class="bi bi-plus-circle me-2"></i>
                    Agregar estudiante
                </a>
            </div>
        </div>

        {{-- Buscar equipos y materiales --}}
        <div class="col-12 col-lg-6">
            <div class="panel h-100">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <div>
                        <h5 class="fw-semibold mb-1">Buscar materiales</h5>
                        <p class="text-secondary mb-0">
                            Consulta si un equipo o material está disponible
                            antes de realizar un préstamo.
                        </p>
                    </div>
                </div>

                <form action="{{ route('equipos.index') }}" method="GET">
                    <label for="buscarMaterial" class="form-label fw-semibold">
                        ¿Qué material necesitas?
                    </label>

                    <div class="input-group mb-3">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>

                        <input
                            type="text"
                            name="buscar"
                            id="buscarMaterial"
                            class="form-control"
                            placeholder="Ej. Laptop, Arduino, libro..."
                        >
                    </div>

                    <p class="small text-secondary mb-3">
                        <i class="bi bi-info-circle me-1"></i>
                        Podrás consultar el nombre, la categoría y el estado
                        de los materiales registrados.
                    </p>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i>
                        Buscar en el inventario
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection