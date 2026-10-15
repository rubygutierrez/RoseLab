<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipoController extends Controller
{
    // Mostrar el inventario completo
    public function index()
    {
        $equipos = Equipo::orderBy('nombre')->get();

        return view('equipos.index', compact('equipos'));
    }

    // Mostrar el formulario de registro
    public function create()
    {
        $equipo = new Equipo();

        return view('equipos.formulario', [
            'equipo' => $equipo,
            'modo' => 'crear',
        ]);
    }

    // Guardar un equipo nuevo
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:255', 'unique:equipos,codigo'],
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'estado' => ['required', Rule::in(['Disponible', 'Prestado'])],
        ], [
            'codigo.required' => 'Ingresa el código del equipo.',
            'codigo.unique' => 'Ese código ya está registrado.',
            'nombre.required' => 'Ingresa el nombre del equipo.',
            'categoria.required' => 'Ingresa la categoría del equipo.',
            'estado.required' => 'Selecciona el estado del equipo.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        Equipo::create($datos);

        return redirect()
            ->route('equipos.index')
            ->with('success', '¡Equipo registrado correctamente!');
    }

    // Mostrar los datos de un equipo
    public function show(Equipo $equipo)
    {
        return view('equipos.formulario', [
            'equipo' => $equipo,
            'modo' => 'ver',
        ]);
    }

    // Mostrar el formulario de edición
    public function edit(Equipo $equipo)
    {
        return view('equipos.formulario', [
            'equipo' => $equipo,
            'modo' => 'editar',
        ]);
    }

    // Actualizar un equipo
    public function update(Request $request, Equipo $equipo)
    {
        $datos = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('equipos', 'codigo')->ignore($equipo->id),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'estado' => ['required', Rule::in(['Disponible', 'Prestado'])],
        ], [
            'codigo.required' => 'Ingresa el código del equipo.',
            'codigo.unique' => 'Ese código ya está registrado.',
            'nombre.required' => 'Ingresa el nombre del equipo.',
            'categoria.required' => 'Ingresa la categoría del equipo.',
            'estado.required' => 'Selecciona el estado del equipo.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        $equipo->update($datos);

        return redirect()
            ->route('equipos.index')
            ->with('success', '¡Equipo actualizado correctamente!');
    }

    // Eliminar un equipo
    public function destroy(Equipo $equipo)
    {
        if ($equipo->prestamos()->exists()) {
            return redirect()
                ->route('equipos.index')
                ->with('error', 'No puedes eliminar este equipo porque tiene préstamos registrados.');
        }

        $equipo->delete();

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}