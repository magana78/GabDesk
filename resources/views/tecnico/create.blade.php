<!-- resources/views/tecnico/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <!-- Formulario para crear un nuevo ticket -->
                <form action="{{ route('tecnico.store') }}" method="POST">
                    @csrf

                    <!-- Título -->
                    <div class="mb-4">
                        <label for="titulo" class="block text-gray-700 dark:text-gray-300">Título</label>
                        <input type="text" name="titulo" id="titulo" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300" required>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300" required></textarea>
                    </div>

                    <!-- Fecha de Creación -->
                    <div class="mb-4">
                        <label for="fecha_creacion" class="block text-gray-700 dark:text-gray-300">Fecha de Creación</label>
                        <input type="datetime-local" name="fecha_creacion" id="fecha_creacion" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300" required>
                    </div>

                    <!-- Fecha de Resolución -->
                    <div class="mb-4">
                        <label for="fecha_resolucion" class="block text-gray-700 dark:text-gray-300">Fecha de Resolución</label>
                        <input type="datetime-local" name="fecha_resolucion" id="fecha_resolucion" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300">
                    </div>

                    <!-- Estado -->
                    <div class="mb-4">
                        <label for="estado_ticket" class="block text-gray-700 dark:text-gray-300">Estado</label>
                        <select name="estado_ticket" id="estado_ticket" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="en proceso">En Proceso</option>
                            <option value="resuelto">Resuelto</option>
                            <option value="cerrado">Cerrado</option>
                        </select>
                    </div>

                    <!-- Prioridad -->
                    <div class="mb-4">
                        <label for="prioridad" class="block text-gray-700 dark:text-gray-300">Prioridad</label>
                        <select name="prioridad" id="prioridad" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300" required>
                            <option value="baja">Baja</option>
                            <option value="media">Media</option>
                            <option value="alta">Alta</option>
                        </select>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-4">
                        <label for="observaciones" class="block text-gray-700 dark:text-gray-300">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300"></textarea>
                    </div>

                    <!-- Confirmado por Usuario -->
                    <div class="mb-4">
                        <label for="confirmado_por_usuario" class="block text-gray-700 dark:text-gray-300">Confirmado por Usuario</label>
                        <select name="confirmado_por_usuario" id="confirmado_por_usuario" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>

                    <!-- Fecha de Confirmación -->
                    <div class="mb-4">
                        <label for="fecha_confirmacion" class="block text-gray-700 dark:text-gray-300">Fecha de Confirmación</label>
                        <input type="datetime-local" name="fecha_confirmacion" id="fecha_confirmacion" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300">
                    </div>

                    <!-- Usuario Reportante -->
                    <div class="mb-4">
                        <label for="id_usuario_reportante" class="block text-gray-700 dark:text-gray-300">Usuario Reportante</label>
                        <select name="id_usuario_reportante" id="id_usuario_reportante" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300" required>
                            <option value="">Seleccione el reportante</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Usuario Asignado -->
                    <div class="mb-4">
                        <label for="id_usuario_asignado" class="block text-gray-700 dark:text-gray-300">Asignar a</label>
                        <select name="id_usuario_asignado" id="id_usuario_asignado" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300">
                            <option value="">Seleccione un usuario</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dispositivo -->
                    <div class="mb-4">
                        <label for="id_dispositivo" class="block text-gray-700 dark:text-gray-300">Dispositivo</label>
                        <select name="id_dispositivo" id="id_dispositivo" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300">
                            <option value="">Seleccione un dispositivo</option>
                            @foreach($dispositivos as $dispositivo)
                                <option value="{{ $dispositivo->id }}">{{ $dispositivo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón de Enviar -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Crear Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
