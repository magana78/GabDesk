<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cambiar Estado del Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('tecnico.cambiarEstado.post', $ticket->id_ticket) }}" method="POST">
                    @csrf
                    <label for="estado_ticket" class="block text-gray-700 dark:text-gray-300 mb-2">Nuevo Estado</label>
                    <select name="estado_ticket" id="estado_ticket" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300">
                        <option value="pendiente" {{ $ticket->estado_ticket == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en proceso" {{ $ticket->estado_ticket == 'en proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="resuelto" {{ $ticket->estado_ticket == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                        <option value="cerrado" {{ $ticket->estado_ticket == 'cerrado' ? 'selected' : '' }}>Cerrado</option>
                    </select>
                    <button type="submit" class="mt-4 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Cambiar Estado
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
