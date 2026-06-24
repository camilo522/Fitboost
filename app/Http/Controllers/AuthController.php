<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function verlogin()
    {
        if (Auth::check()) {
            return redirect()->route('welcome');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        // Validación
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión correctamente.');
    }
}
