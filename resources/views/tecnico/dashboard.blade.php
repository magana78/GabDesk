<x-app-layout>

    <div class="shrink-0 flex items-center">
        <a href="{{ route('tecnico.dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>
    
    <!-- Definir el slot del encabezado -->
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Técnico de Soporte') }} <!-- Título del panel -->
        </h2>
    </x-slot>

    <!-- Contenido principal del dashboard -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de bienvenida -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-xl font-bold">
                    {{ __("¡Bienvenido, Técnico de Soporte!") }}
                </div>
                <div class="p-6 text-gray-600 dark:text-gray-400">
                    {{ __("Desde aquí puedes gestionar tus tickets y mantener un seguimiento de las tareas asignadas.") }}
                </div>
            </div>

            <!-- Sección de menú con botones para la gestión de tickets -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Opción para ver todos los tickets -->
                <a href="{{ route('tecnico.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg text-center">
                    {{ __('Ver Todos los Tickets') }}
                </a>

                <!-- Opción para crear un nuevo ticket -->
                <a href="{{ route('tecnico.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg text-center">
                    {{ __('Crear Nuevo Ticket') }}
                </a>

                <!-- Opción para ver los tickets resueltos -->
                <a href="{{ route('tecnico.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg text-center">
                    {{ __('Ver Tickets Resueltos') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
