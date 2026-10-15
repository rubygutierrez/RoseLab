@extends('layouts.app')

@section('title', 'Inventario de equipos')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="page-title">Inventario de equipos</h2>
            <p class="page-description mb-0">
                Consulta y administra los equipos registrados en RoseLab.
            </p>
        </div>

        <a href="{{ route('equipos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>
            Registrar equipo
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Total de equipos</span>
                    <div class="stat-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
                <div class="stat-number">{{ $equipos->count() }}</div>
                <small class="text-secondary">Equipos registrados</small>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Disponibles</span>
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <div class="stat-number">
                    {{ $equipos->where('estado', 'Disponible')->count() }}
                </div>
                <small class="text-secondary">Listos para préstamo</small>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="stat-label">Prestados</span>
                    <div class="stat-icon">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                </div>
                <div class="stat-number">
                    {{ $equipos->where('estado', 'Prestado')->count() }}
                </div>
                <small class="text-secondary">Equipos prestados</small>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h5 class="fw-semibold mb-1">Todos los equipos</h5>
                <p class="text-secondary mb-0">
                    Total: {{ $equipos->count() }} registros
                </p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Equipo</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($equipos as $equipo)
                        <tr>
                            <td class="fw-semibold">{{ $equipo->codigo }}</td>
                            <td>{{ $equipo->nombre }}</td>
                            <td>{{ $equipo->categoria }}</td>
                            <td>
                                @if ($equipo->estado === 'Disponible')
                                    <span class="status-available">Disponible</span>
                                @else
                                    <span class="status-loaned">Prestado</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <div class="d-inline-flex flex-wrap justify-content-end gap-1">
                                    <a href="{{ route('equipos.show', $equipo) }}"
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Ver equipo"
                                       aria-label="Ver equipo">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('equipos.edit', $equipo) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Editar equipo"
                                       aria-label="Editar equipo">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('equipos.destroy', $equipo) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este equipo?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Eliminar equipo"
                                                aria-label="Eliminar equipo">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-secondary"></i>
                                <h6 class="fw-semibold mt-3">Todavía no hay equipos</h6>
                                <p class="text-secondary">
                                    Registra tu primer equipo para que aparezca en el inventario.
                                </p>

                                <a href="{{ route('equipos.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Registrar primer equipo
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection