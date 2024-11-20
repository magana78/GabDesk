<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\View\View;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;



class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function showRegistrationForm(): View
    {
        // Verificar si el usuario actual es administrador
        if (!Auth::user() || !Auth::user()->hasRole('Administrador')) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        // Obtener todos los roles y departamentos para mostrarlos en el formulario de registro
        $roles = Role::all();
        $departamentos = Departamento::all();

        return view('admin.register', compact('roles', 'departamentos'));
    }

    /**
     * Maneja la solicitud de registro.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Verificar si el usuario actual es administrador
        if (!Auth::user() || !Auth::user()->hasRole('Administrador')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::exists('roles', 'nombre_rol')],
            'estado' => ['required', 'in:activo,inactivo'],
            'id_departamento' => ['required', 'exists:departamentos,id_departamento'],
            'id_area' => ['required', 'exists:areas,id_area'],
            'id_ubicacion' => ['required', 'exists:ubicaciones,id_ubicacion'],
            'id_cubiculo' => ['required', 'exists:cubiculos,id_cubiculo'],
        ]);

        // Crear el usuario con los datos proporcionados
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estado' => $request->estado,
            'id_departamento' => $request->id_departamento,
            'id_area' => $request->id_area,
            'id_ubicacion' => $request->id_ubicacion,
            'id_cubiculo' => $request->id_cubiculo,
        ]);

        // Asignar el rol al usuario
        if ($usuario) {
            $usuario->assignRole($request->role);

            // Disparar el evento de registro
            event(new Registered($usuario));

            // Mostrar mensaje de éxito
            return redirect()->route('admin.register')->with('success', 'Usuario creado con éxito.');
        } else {
            // Manejo de error si el usuario no se creó correctamente
            return redirect()->back()->withErrors(['error' => 'Error al crear el usuario.']);
        }
    }
}