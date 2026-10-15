@extends('layouts.app')

@section('title', $modo === 'crear' ? 'Registrar equipo' : ($modo === 'editar' ? 'Editar equipo' : 'Detalle del equipo'))

@section('content')
    <div class="mb-4">
        <a href="{{ route('equipos.index') }}" class="text-decoration-none text-secondary small">
            <i class="bi bi-arrow-left me-1"></i> Volver al inventario
        </a>

        <h2 class="page-title mt-3">
            @if ($modo === 'crear')
                Registrar equipo
            @elseif ($modo === 'editar')
                Editar equipo
            @else
                Detalle del equipo
            @endif
        </h2>

        <p class="page-description">
            @if ($modo === 'crear')
                Completa los datos para agregar un equipo al inventario.
            @elseif ($modo === 'editar')
                Modifica los datos del equipo seleccionado.
            @else
                Consulta la información del equipo registrado.
            @endif
        </p>
    </div>

    <div class="panel">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Revisa los siguientes campos:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($modo === 'editar')
            <form action="{{ route('equipos.update', $equipo) }}" method="POST">
                @csrf
                @method('PUT')
        @elseif ($modo === 'crear')
            <form action="{{ route('equipos.store') }}" method="POST">
                @csrf
        @else
            <form>
        @endif

            <fieldset @if ($modo === 'ver') disabled @endif>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label for="codigo" class="form-label fw-semibold">Código del equipo</label>
                        <input
                            type="text"
                            id="codigo"
                            name="codigo"
                            class="form-control @error('codigo') is-invalid @enderror"
                            value="{{ old('codigo', $equipo->codigo) }}"
                            placeholder="Ej. EQ-001"
                            maxlength="255"
                            required
                        >
                        @error('codigo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label fw-semibold">Nombre del equipo</label>
                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="form-control @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $equipo->nombre) }}"
                            placeholder="Ej. Laptop Lenovo"
                            maxlength="255"
                            required
                        >
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="categoria" class="form-label fw-semibold">Categoría</label>
                        <input
                            type="text"
                            id="categoria"
                            name="categoria"
                            class="form-control @error('categoria') is-invalid @enderror"
                            value="{{ old('categoria', $equipo->categoria) }}"
                            placeholder="Ej. Computación"
                            maxlength="255"
                            required
                        >
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="estado" class="form-label fw-semibold">Estado del equipo</label>
                        <select
                            id="estado"
                            name="estado"
                            class="form-select @error('estado') is-invalid @enderror"
                            required
                        >
                            <option value="Disponible"
                                {{ old('estado', $equipo->estado ?? 'Disponible') === 'Disponible' ? 'selected' : '' }}>
                                Disponible
                            </option>
                            <option value="Prestado"
                                {{ old('estado', $equipo->estado ?? 'Disponible') === 'Prestado' ? 'selected' : '' }}>
                                Prestado
                            </option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </fieldset>

            <div class="d-flex flex-wrap gap-2 mt-4 pt-3 border-top">
                @if ($modo !== 'ver')
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-lg me-2"></i>
                        {{ $modo === 'crear' ? 'Guardar equipo' : 'Guardar cambios' }}
                    </button>
                @endif

                <a href="{{ route('equipos.index') }}" class="btn btn-outline-secondary px-4">
                    {{ $modo === 'ver' ? 'Volver' : 'Cancelar' }}
                </a>
            </div>
        </form>
    </div>
@endsection
