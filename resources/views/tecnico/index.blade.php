<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todos los Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <!-- Mostrar todos los tickets -->
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->titulo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->estado_ticket }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-4">
                                        <!-- Botón de Editar -->
                                        <a href="{{ route('tecnico.edit', $ticket->id_ticket) }}" class="text-blue-600 hover:text-blue-900">Editar</a>

                                        <!-- Botón de Eliminar con un formulario -->
                                        <form action="{{ route('tecnico.destroy', $ticket->id_ticket) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ticket?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
