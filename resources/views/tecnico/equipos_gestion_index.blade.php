<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <a href="{{ route('tecnico.equipos.gestion.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-4 inline-block">
                        Crear Nuevo Equipo
                    </a>

                    <div class="mt-6">
                        @if($equipos->isEmpty())
                            <p class="text-gray-600 dark:text-gray-300">No hay equipos agregados aún. Los equipos nuevos aparecerán aquí.</p>
                        @else
                            <table class="min-w-full bg-gray-100 dark:bg-gray-900 rounded-lg">
                                <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Imagen</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Nombre del Equipo</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Descripción</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Número de Serie</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Dispositivos</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Usuario Asignado</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($equipos as $equipo)
                                    <tr class="border-b border-gray-300 dark:border-gray-700">
                                        <!-- Columna de Imagen -->
                                        <td class="px-4 py-2">
                                            @if($equipo->imagenesequipos->isNotEmpty())
                                                <img src="{{ asset('storage/' . $equipo->imagenesequipos->first()->ruta) }}" alt="Imagen del equipo" class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <span class="text-gray-600 dark:text-gray-400">Sin Imagen</span>
                                            @endif
                                        </td>
                                        <!-- Nombre del Equipo -->
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-200">{{ $equipo->nombre_equipo }}</td>
                                        <!-- Descripción -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $equipo->descripcion }}</td>
                                        <!-- Número de Serie -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ $equipo->numero_serie }}</td>
                                        <!-- Dispositivos -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                            @if($equipo->dispositivos->isNotEmpty())
                                                <ul>
                                                    @foreach($equipo->dispositivos as $dispositivo)
                                                        <li>{{ $dispositivo->tipo_dispositivo }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                Sin Dispositivos
                                            @endif
                                        </td>
                                        <!-- Usuario Asignado -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                            {{ $equipo->usuario ? $equipo->usuario->nombre : 'No asignado' }}
                                        </td>
                                        <!-- Acciones -->
                                        <td class="px-4 py-2 flex space-x-2">
                                            <!-- Botón de Ver Detalles -->
                                            <a href="{{ route('tecnico.equipos_gestion_show', $equipo->id_equipo) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                                Ver Detalles
                                            </a>
                                            <a href="{{ route('tecnico.equipos.gestion.addImage', $equipo) }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                                {{ $equipo->imagenesequipos->isEmpty() ? 'Agregar Foto' : 'Actualizar Foto' }}
                                            </a>
                                            <a href="{{ route('tecnico.equipos.gestion.assignUser', $equipo) }}" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                                {{ $equipo->usuario ? 'Cambiar Usuario' : 'Asignar Usuario' }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- Enlaces de paginación -->
                            <div class="mt-6">
                                {{ $equipos->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
