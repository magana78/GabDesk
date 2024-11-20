<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Verifica el tipo de objeto que devuelve Auth::user()
        $user = Auth::user();
        if (!$user) {
            return redirect('login')->with('error', 'No estás autenticado.');
        }
    
        if (!($user instanceof \App\Models\Usuario)) {
            return redirect('dashboard')->with('error', 'El usuario autenticado no es del tipo esperado.');
        }
    
        if (!$user->hasRole($role)) {
            return redirect()->route('dashboard')->with('error', 'No tienes acceso a esta sección.');
        }
    
        return $next($request);
    }
}