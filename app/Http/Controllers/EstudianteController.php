<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EstudianteController extends Controller
{
    // Mostrar el formulario
    public function create()
    {
        return view('estudiantes.create');
    }

    // Guardar al estudiante en la base de datos
    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.required' => 'Escribe el nombre del estudiante.',
            'email.required' => 'Escribe el correo electrónico.',
            'email.email' => 'El correo no tiene un formato válido.',
            'email.unique' => 'Ya existe un usuario con ese correo.',
            'password.required' => 'Escribe una contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $datos['password'] = Hash::make($datos['password']);
        $datos['rol'] = 'estudiante';

        User::create($datos);

        return redirect()
            ->route('dashboard')
            ->with('success', 'El estudiante se registró correctamente.');
    }
}
