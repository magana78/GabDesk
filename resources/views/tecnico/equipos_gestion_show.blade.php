<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 space-y-6">
                    <!-- Mostrar la imagen del equipo -->
                    <div class="mb-6">
                        @if($equipo->imagenesequipos->isNotEmpty())
                            <img src="{{ asset('storage/' . $equipo->imagenesequipos->first()->ruta) }}" alt="Imagen del equipo" class="w-full max-w-lg mx-auto object-contain rounded-lg shadow-md">
                        @else
                            <span class="text-gray-600 dark:text-gray-400">Sin Imagen</span>
                        @endif
                    </div>

                    <!-- Información general del equipo -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Información General</h3>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Nombre:</strong> {{ $equipo->nombre_equipo }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Descripción:</strong> {{ $equipo->descripcion }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Número de Serie:</strong> {{ $equipo->numero_serie }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Estado:</strong> {{ $equipo->estado_equipo }}</p>
                    </div>

                    <!-- Dispositivos asociados y sus accesorios -->
                    <div>
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200">Dispositivos del Equipo</h4>
                        <ul class="mt-2 space-y-2">
                            @foreach($equipo->dispositivos as $dispositivo)
                                <li class="text-gray-600 dark:text-gray-300">
                                    <!-- Mostrar solo tipo de dispositivo -->
                                    <strong>{{ $dispositivo->tipo_dispositivo }}</strong>
                                    <!-- Accesorios del dispositivo -->
                                    @if($dispositivo->accesorios && $dispositivo->accesorios->isNotEmpty())
                                        <ul class="ml-4 mt-1">
                                            @foreach($dispositivo->accesorios as $accesorio)
                                                <li>- {{ $accesorio->nombre_accesorio ?? 'Accesorio sin nombre' }} - {{ $accesorio->estado_accesorio ? 'Operativo' : 'No Operativo' }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="ml-4 text-sm text-gray-500"></p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Botón de regreso -->
                    <div>
                        <a href="{{ route('tecnico.equipos.gestion.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                            Volver a la Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
