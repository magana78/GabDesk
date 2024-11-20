<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    public function index(Role $role)
{
    $permissions = Permission::all();
    $assignedPermissions = $role->permissions()->select('permissions.id_permission')->pluck('id_permission')->toArray();

    return view('admin.roles.permissions.index', compact('role', 'permissions', 'assignedPermissions'));
}
    
public function store(Request $request, Role $role)
{
    // Obtener permisos seleccionados del formulario
    $permissions = $request->input('permissions', []);

    // Sincronizar permisos del rol
    $role->permissions()->sync($permissions);

    // Redireccionar con un mensaje de éxito
    return redirect()->route('admin.roles.permissions.index', $role->id_rol)
        ->with('success', 'Permisos actualizados correctamente.');
}

}