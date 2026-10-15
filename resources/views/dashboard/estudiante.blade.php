@extends('layouts.app')

@section('title', 'Panel del estudiante')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">
            Hola, {{ auth()->user()->name }}
        </h2>

        <p class="page-description">
            Consulta los equipos que puedes solicitar en el laboratorio.
        </p>
    </div>

    <div class="panel mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-icon">
                <i class="bi bi-info-circle"></i>
            </div>

            <div>
                <h5 class="fw-semibold mb-1">Consulta de equipos</h5>
                <p class="text-secondary mb-0">
                    Aquí puedes revisar la disponibilidad del inventario.
                    Solo el encargado puede registrar cambios.
                </p>
            </div>
        </div>
    </div>

    <div class="panel">
        <h5 class="fw-semibold mb-3">Equipos disponibles</h5>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Equipo</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($equiposDisponibles ?? [] as $equipo)
                        <tr>
                            <td class="fw-semibold">{{ $equipo->codigo }}</td>
                            <td>{{ $equipo->nombre }}</td>
                            <td>{{ $equipo->categoria }}</td>
                            <td>
                                <span class="status-available">Disponible</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-secondary">
                                <i class="bi bi-inbox fs-2 d-block mb-3"></i>
                                No hay equipos disponibles en este momento.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection