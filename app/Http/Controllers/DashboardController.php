<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $usuario = $request->user();

        if ($usuario->rol === 'encargado') {
            return view('dashboard.encargado', [
                'totalEquipos' => Equipo::count(),
                'equiposDisponibles' => Equipo::where(
                    'estado',
                    'Disponible'
                )->count(),
                'prestamosActivos' => Prestamo::where(
                    'estado',
                    'Activo'
                )->count(),
                'ultimosEquipos' => Equipo::latest()->take(5)->get(),
            ]);
        }

        if ($usuario->rol === 'estudiante') {
            return view('dashboard.estudiante', [
                'equiposDisponibles' => Equipo::where(
                    'estado',
                    'Disponible'
                )->orderBy('nombre')->get(),
            ]);
        }

        abort(403, 'No tienes un rol autorizado para ingresar.');
    }
}
