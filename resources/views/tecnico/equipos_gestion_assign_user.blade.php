<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asignar Usuario al Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <form action="{{ route('tecnico.equipos.gestion.assign', $equipo->id_equipo) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="usuario_id" class="block text-gray-700 dark:text-gray-300">Seleccionar Usuario</label>
                            <select name="usuario_id" id="usuario_id" class="w-full p-2 border rounded-lg">
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                                Asignar Usuario
                            </button>
                            <a href="{{ route('tecnico.equipos.gestion.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow ml-2">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
