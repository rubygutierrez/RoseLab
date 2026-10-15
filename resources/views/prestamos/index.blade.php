@extends('layouts.app')

@section('title', 'Préstamos')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="page-title">Préstamos</h2>
            <p class="page-description mb-0">
                Consulta los equipos prestados y registra sus devoluciones.
            </p>
        </div>

        @if (auth()->user()->rol === 'encargado')
            <a href="{{ route('prestamos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>
                Registrar préstamo
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>No se pudo completar la operación.</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="panel">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Estudiante</th>
                        <th>Encargado</th>
                        <th>Fecha del préstamo</th>
                        <th>Fecha prevista de entrega</th>
                        <th>Estado</th>

                        @if (auth()->user()->rol === 'encargado')
                            <th>Acciones</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse ($prestamos as $prestamo)
                        <tr>
                            <td>
                                <div class="fw-semibold">
                                    {{ $prestamo->equipo->nombre ?? 'Equipo no disponible' }}
                                </div>

                                <small class="text-secondary">
                                    {{ $prestamo->equipo->codigo ?? '—' }}
                                </small>
                            </td>

                            <td>
                                {{ $prestamo->estudiante->name ?? '—' }}
                            </td>

                            <td>
                                {{ $prestamo->encargado->name ?? '—' }}
                            </td>

                            <td>
                                {{ $prestamo->fecha_prestamo?->format('d/m/Y H:i') ?? '—' }}
                            </td>

                            <td>
                                {{ $prestamo->fecha_entrega?->format('d/m/Y') ?? '—' }}

                                @if (
                                    $prestamo->estado === 'Activo' &&
                                    $prestamo->fecha_entrega &&
                                    $prestamo->fecha_entrega->lt(now()->startOfDay())
                                )
                                    <div class="text-danger small fw-semibold">
                                        Fecha vencida
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if ($prestamo->estado === 'Activo')
                                    <span class="status-loaned">Activo</span>
                                @else
                                    <span class="status-available">Devuelto</span>

                                    @if ($prestamo->fecha_devolucion)
                                        <div class="text-secondary small mt-1">
                                            Devuelto el:
                                            {{ $prestamo->fecha_devolucion->format('d/m/Y H:i') }}
                                        </div>
                                    @endif
                                @endif
                            </td>

                            @if (auth()->user()->rol === 'encargado')
                                <td>
                                    @if ($prestamo->estado === 'Activo')
                                        <form
                                            action="{{ route('prestamos.devolver', $prestamo) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Confirmas la devolución de este equipo?')"
                                        >
                                            @csrf

                                            <button type="submit" class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Devolver
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-secondary small">
                                            Completado
                                        </span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td
                                colspan="{{ auth()->user()->rol === 'encargado' ? 7 : 6 }}"
                                class="text-center py-5"
                            >
                                <i class="bi bi-arrow-left-right fs-2 text-secondary"></i>

                                <p class="fw-semibold mt-3 mb-1">
                                    Todavía no hay préstamos
                                </p>

                                <p class="text-secondary mb-0">
                                    Cuando registres un préstamo, aparecerá aquí.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
