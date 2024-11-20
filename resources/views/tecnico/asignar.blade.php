<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asignar Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('tecnico.asignar.post', $ticket->id_ticket) }}" method="POST">
                    @csrf
                    <label for="id_usuario_asignado" class="block text-gray-700 dark:text-gray-300 mb-2">Asignar a Técnico</label>
                    <select name="id_usuario_asignado" id="id_usuario_asignado" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300">
                        @foreach($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id_usuario }}">{{ $tecnico->nombre }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Asignar Ticket
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
