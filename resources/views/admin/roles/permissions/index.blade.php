<x-app-layout>
    <x-navbar />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permisos para el Rol: ') . $role->nombre_rol }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('admin.roles.permissions.store', $role->id_rol) }}" method="POST">
                    @csrf
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b">Permiso</th>
                                <th class="px-6 py-3 border-b">Asignado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td class="px-6 py-4 border-b">{{ $permission->nombre_permission }}</td>
                                    <td class="px-6 py-4 border-b text-center">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id_permission }}"
                                            {{ in_array($permission->id_permission, $assignedPermissions) ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Actualizar Permisos
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
