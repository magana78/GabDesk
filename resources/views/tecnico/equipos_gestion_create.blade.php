<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-gradient-to-r bg-[#00CFFF]  p-2 mt-4 rounded-lg hover:bg-[#009FCC]  rounded-t-lg">
                    <h3 class="text-lg font-semibold">Información del Nuevo Equipo</h3>
                    <p class="text-sm opacity-90">Rellena los campos a continuación para registrar un nuevo equipo en el sistema.</p>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('tecnico.equipos.gestion.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Nombre del Equipo -->
                        <div>
                            <label for="nombre_equipo" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                Nombre del Equipo
                            </label>
                            <input 
                                type="text" 
                                name="nombre_equipo" 
                                id="nombre_equipo" 
                                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ej. Servidor Principal"
                                required>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label for="descripcion" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                Descripción
                            </label>
                            <textarea 
                                name="descripcion" 
                                id="descripcion" 
                                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                rows="4" 
                                placeholder="Ej. Equipo utilizado para gestionar el almacenamiento principal..."></textarea>
                        </div>

                        <!-- Número de Serie -->
                        <div>
                            <label for="numero_serie" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">
                                Número de Serie
                            </label>
                            <input 
                                type="text" 
                                name="numero_serie" 
                                id="numero_serie" 
                                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Ej. ABC123XYZ"
                                required>
                        </div>

                        <!-- Botón de Crear -->
                        <div class="text-center">
                            <button type="submit" 
                                class="bg-[#00CFFF] text-white p-2 mt-4 rounded-lg hover:bg-[#009FCC] transition">
                                Crear Equipo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
