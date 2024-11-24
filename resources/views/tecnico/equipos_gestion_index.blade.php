<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <!-- Botón para Crear Nuevo Equipo -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 md:mb-0">
                        Lista de Equipos
                    </h3>
                    <a href="{{ route('tecnico.equipos.gestion.create') }}" 
                       class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                        + Crear Nuevo Equipo
                    </a>
                </div>

                <!-- Tabla de Equipos -->
                @if($equipos->isEmpty())
                    <div class="text-center text-gray-600 dark:text-gray-400 py-10">
                        <p>No hay equipos agregados aún. Los equipos nuevos aparecerán aquí.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table-auto min-w-full bg-[#00CFFF] text-white rounded-lg shadow-md">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">Nombre del Equipo</th>
                                    <th class="px-4 py-3 text-left font-semibold">Descripción</th>
                                    <th class="px-4 py-3 text-left font-semibold">Número de Serie</th>
                                    <th class="px-4 py-3 text-left font-semibold">Usuario Asignado</th>
                                    <th class="px-4 py-3 text-center font-semibold">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white text-gray-800 dark:bg-gray-700">
                                @foreach($equipos as $equipo)
                                    <tr class="border-b border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                                        <!-- Nombre del Equipo -->
                                        <td class="px-4 py-3 font-medium">
                                            {{ $equipo->nombre_equipo }}
                                        </td>
                                        <!-- Descripción -->
                                        <td class="px-4 py-3">
                                            {{ $equipo->descripcion }}
                                        </td>
                                        <!-- Número de Serie -->
                                        <td class="px-4 py-3">
                                            {{ $equipo->numero_serie }}
                                        </td>
                                        <!-- Usuario Asignado -->
                                        <td class="px-4 py-3">
                                            {{ $equipo->usuario ? $equipo->usuario->nombre : 'No asignado' }}
                                        </td>
                                        <!-- Acciones -->
                                        <td class="px-4 py-3 flex flex-col md:flex-row justify-center items-center md:space-x-2 space-y-2 md:space-y-0">
                                            <!-- Botón de Ver Detalles -->
                                            <a href="{{ route('tecnico.equipos_gestion_show', $equipo->id_equipo) }}" 
                                               class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                                                Ver
                                            </a>
                                            <!-- Botón de Agregar Imagen -->
                                            <a href="{{ $equipo->imagenesequipos->count() < 3 ? route('tecnico.equipos.gestion.addImage', $equipo) : '#' }}" 
                                               class="{{ $equipo->imagenesequipos->count() < 3 ? 'bg-gray-300 hover:bg-gray-400' : 'bg-gray-400 cursor-not-allowed' }} 
                                                      text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                                                {{ $equipo->imagenesequipos->count() < 3 ? 'Agregar Imagen' : 'Máximo alcanzado' }}
                                            </a>
                                            <!-- Botón de Asignar Usuario -->
                                            <a href="{{ route('tecnico.equipos.gestion.assignUser', $equipo) }}" 
                                               class="border-2 border-[#00CFFF] text-[#00CFFF] hover:text-[#009FCC] hover:bg-[#E6F9FF] px-4 py-2 rounded transition duration-150">
                                                {{ $equipo->usuario ? 'Cambiar Usuario' : 'Asignar Usuario' }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $equipos->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
