<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('tecnico.equipos.gestion.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nombre_equipo" class="block text-gray-700 dark:text-gray-300">Nombre del Equipo</label>
                            <input type="text" name="nombre_equipo" id="nombre_equipo" class="w-full p-2 border rounded-lg" required>
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 dark:text-gray-300">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="w-full p-2 border rounded-lg"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="numero_serie" class="block text-gray-700 dark:text-gray-300">Número de Serie</label>
                            <input type="text" name="numero_serie" id="numero_serie" class="w-full p-2 border rounded-lg" required>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                                Crear Equipo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
