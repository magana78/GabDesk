<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if (!($user instanceof \App\Models\Usuario)) {
            throw new \Exception('El usuario autenticado no es una instancia de Usuario.');
        }

        // Redirigir según el rol del usuario usando el método hasRole
        if ($user->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');  // Redirigir al dashboard del administrador
        } elseif ($user->hasRole('Técnico de soporte')) {
            return redirect()->route('tecnico.dashboard');  // Redirigir al dashboard del técnico de soporte
        } elseif ($user->hasRole('Supervisor')) {
            return redirect()->route('supervisor.dashboard');  // Redirigir al dashboard del supervisor (si es necesario)
        }

        // Si el usuario no tiene un rol permitido, cerrar sesión y redirigir a la página de inicio con un mensaje de error.
        Auth::logout();
        return redirect()->route('login')->withErrors(['role' => 'No tienes permisos para acceder a esta cuenta.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}