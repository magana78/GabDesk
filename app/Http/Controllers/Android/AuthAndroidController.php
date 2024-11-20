<?php

// app/Http/Controllers/AuthAndroidController.php

namespace App\Http\Controllers\Android;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class AuthAndroidController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            return response()->json(['success' => true, 'user' => $user]);
        }

        return response()->json(['success' => false, 'message' => 'Credenciales inválidas.']);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Sesión cerrada.']);
    }
}
