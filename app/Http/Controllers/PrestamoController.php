<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PrestamoController extends Controller
{
    /**
     * Mostrar los préstamos registrados.
     */
    public function index()
    {
        $prestamos = Prestamo::with([
            'equipo',
            'estudiante',
            'encargado'
        ])
        ->latest()
        ->get();

        return view('prestamos.index', compact('prestamos'));
    }

    /**
     * Mostrar el formulario para registrar un préstamo.
     */
    public function create()
    {
        $equipos = Equipo::where('estado', 'Disponible')
            ->orderBy('nombre')
            ->get();

        $estudiantes = User::where('rol', 'estudiante')
            ->orderBy('name')
            ->get();

        return view('prestamos.create', compact(
            'equipos',
            'estudiantes'
        ));
    }

    /**
     * Registrar un préstamo.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'equipo_id' => ['required', 'integer', 'exists:equipos,id'],
            'estudiante_id' => ['required', 'integer', 'exists:users,id'],
            'fecha_entrega' => ['required', 'date', 'after_or_equal:today'],
        ], [
            'equipo_id.required' => 'Selecciona un equipo.',
            'equipo_id.exists' => 'El equipo seleccionado no existe.',

            'estudiante_id.required' => 'Selecciona un estudiante.',
            'estudiante_id.exists' => 'El estudiante seleccionado no existe.',

            'fecha_entrega.required' => 'Selecciona la fecha de entrega.',
            'fecha_entrega.date' => 'La fecha de entrega no es válida.',
            'fecha_entrega.after_or_equal' => 'La fecha de entrega debe ser hoy o una fecha futura.',
        ]);

        if ($request->user()->rol !== 'encargado') {
            abort(403, 'Solo el encargado puede registrar préstamos.');
        }

        DB::transaction(function () use ($datos, $request) {
            $equipo = Equipo::whereKey($datos['equipo_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($equipo->estado !== 'Disponible') {
                throw ValidationException::withMessages([
                    'equipo_id' => 'Este equipo ya está prestado.',
                ]);
            }

            $estudiante = User::whereKey($datos['estudiante_id'])
                ->where('rol', 'estudiante')
                ->first();

            if (!$estudiante) {
                throw ValidationException::withMessages([
                    'estudiante_id' => 'Selecciona un usuario con rol de estudiante.',
                ]);
            }

            Prestamo::create([
                'equipo_id' => $equipo->id,
                'estudiante_id' => $estudiante->id,
                'encargado_id' => $request->user()->id,
                'fecha_prestamo' => now(),
                'fecha_entrega' => $datos['fecha_entrega'],
                'fecha_devolucion' => null,
                'estado' => 'Activo',
            ]);

            $equipo->update([
                'estado' => 'Prestado',
            ]);
        });

        return redirect()
            ->route('prestamos.index')
            ->with('success', 'El préstamo se registró correctamente.');
    }

    /**
     * Registrar la devolución de un equipo.
     */
    public function devolver(Request $request, Prestamo $prestamo)
    {
        if ($request->user()->rol !== 'encargado') {
            abort(403, 'Solo el encargado puede registrar devoluciones.');
        }

        DB::transaction(function () use ($prestamo) {
            $prestamo = Prestamo::whereKey($prestamo->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($prestamo->estado !== 'Activo') {
                throw ValidationException::withMessages([
                    'prestamo' => 'Este préstamo ya fue devuelto.',
                ]);
            }

            $equipo = Equipo::whereKey($prestamo->equipo_id)
                ->lockForUpdate()
                ->firstOrFail();

            $prestamo->update([
                'estado' => 'Devuelto',
                'fecha_devolucion' => now(),
            ]);

            $equipo->update([
                'estado' => 'Disponible',
            ]);
        });

        return redirect()
            ->route('prestamos.index')
            ->with('success', 'La devolución se registró correctamente.');
    }
}
