@extends('layouts.app')

@section('title', 'Registrar préstamo')

@section('content')
    <div class="mb-4">
        <h2 class="page-title">Registrar préstamo</h2>
        <p class="page-description">
            Selecciona el equipo disponible, el estudiante que lo recibirá y la fecha prevista de entrega.
        </p>
    </div>

    <div class="panel">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($equipos->isEmpty())
            <div class="alert alert-warning">
                No hay equipos disponibles para prestar.
                Primero registra un equipo o devuelve uno prestado.
            </div>
        @elseif ($estudiantes->isEmpty())
            <div class="alert alert-warning">
                No hay usuarios con rol de estudiante registrados.
            </div>
        @else
            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="equipo_id" class="form-label fw-semibold">
                        Equipo
                    </label>

                    <select
                        name="equipo_id"
                        id="equipo_id"
                        class="form-select"
                        required
                    >
                        <option value="">Selecciona un equipo</option>

                        @foreach ($equipos as $equipo)
                            <option
                                value="{{ $equipo->id }}"
                                @selected(old('equipo_id') == $equipo->id)
                            >
                                {{ $equipo->codigo }} — {{ $equipo->nombre }}
                                ({{ $equipo->categoria }})
                            </option>
                        @endforeach
                    </select>

                    @error('equipo_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estudiante_id" class="form-label fw-semibold">
                        Estudiante
                    </label>

                    <select
                        name="estudiante_id"
                        id="estudiante_id"
                        class="form-select"
                        required
                    >
                        <option value="">Selecciona un estudiante</option>

                        @foreach ($estudiantes as $estudiante)
                            <option
                                value="{{ $estudiante->id }}"
                                @selected(old('estudiante_id') == $estudiante->id)
                            >
                                {{ $estudiante->name }} — {{ $estudiante->email }}
                            </option>
                        @endforeach
                    </select>

                    @error('estudiante_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="fecha_entrega" class="form-label fw-semibold">
                        Fecha prevista de entrega
                    </label>

                    <input
                        type="date"
                        name="fecha_entrega"
                        id="fecha_entrega"
                        class="form-control"
                        min="{{ date('Y-m-d') }}"
                        value="{{ old('fecha_entrega') }}"
                        required
                    >

                    @error('fecha_entrega')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <small class="text-secondary">
                        Selecciona el día en que el estudiante debe devolver el equipo.
                    </small>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>
                        Confirmar préstamo
                    </button>

                    <a href="{{ route('prestamos.index') }}"
                       class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        @endif

        @if ($equipos->isEmpty() || $estudiantes->isEmpty())
            <a href="{{ route('prestamos.index') }}"
               class="btn btn-outline-secondary">
                Volver a préstamos
            </a>
        @endif
    </div>
@endsection
