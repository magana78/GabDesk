<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Administración') }} <!-- Título del Dashboard -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenido al Panel de Administración") }} <!-- Mensaje de bienvenida -->
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de gestión -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full border-collapse block md:table">
                <thead class="block md:table-header-group">
                    <tr class="border border-gray-300 md:border-none md:table-row">
                        <th class="block md:table-cell p-2 text-left text-gray-800 dark:text-gray-200">Título</th>
                        <th class="block md:table-cell p-2 text-left text-gray-800 dark:text-gray-200">Estado</th>
                        <th class="block md:table-cell p-2 text-left text-gray-800 dark:text-gray-200">Acciones</th>
                    </tr>
                </thead>
                <tbody class="block md:table-row-group">
                    <!-- Ejemplo de fila de datos -->
                    <tr class="border border-gray-300 md:border-none md:table-row">
                        <td class="block md:table-cell p-2">Tarea de Ejemplo</td>
                        <td class="block md:table-cell p-2">Activo</td>
                        <td class="block md:table-cell p-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Editar
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <!-- Repite las filas para más datos -->
                    <tr class="border border-gray-300 md:border-none md:table-row">
                        <td class="block md:table-cell p-2">Otra Tarea</td>
                        <td class="block md:table-cell p-2">Inactivo</td>
                        <td class="block md:table-cell p-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                Editar
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
