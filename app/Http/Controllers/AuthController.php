<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $datos = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Escribe tu correo electrónico.',
            'email.email' => 'Ingresa un correo válido.',
            'password.required' => 'Escribe tu contraseña.',
        ]);

        $claveLimite = Str::lower($datos['email']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($claveLimite, 5)) {
            throw ValidationException::withMessages([
                'email' => 'Demasiados intentos. Espera un momento.',
            ]);
        }

        if (!Auth::attempt($datos)) {
            RateLimiter::hit($claveLimite, 60);

            throw ValidationException::withMessages([
                'email' => 'El correo o la contraseña son incorrectos.',
            ]);
        }

        RateLimiter::clear($claveLimite);

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
