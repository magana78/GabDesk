<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-6 text-gray-900 dark:text-gray-100">{{ __('Información del Ticket') }}</h3>

                <!-- Formulario para editar ticket -->
                <form action="{{ route('tecnico.update', $ticket) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Sección Principal del Ticket -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Título del Ticket -->
                        <div class="col-span-1">
                            <x-label for="titulo" :value="__('Título del Ticket')" />
                            <x-text-input id="titulo" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                          type="text" name="titulo" value="{{ $ticket->titulo }}" required 
                                          placeholder="Título del ticket" />
                        </div>

                        <!-- Prioridad -->
                        <div class="col-span-1">
                            <x-label for="prioridad" :value="__('Prioridad')" />
                            <select id="prioridad" name="prioridad" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <option value="baja" {{ $ticket->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
                                <option value="media" {{ $ticket->prioridad == 'media' ? 'selected' : '' }}>Media</option>
                                <option value="alta" {{ $ticket->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
                            </select>
                        </div>

                        <!-- Estado del Ticket -->
                        <div class="col-span-1">
                            <x-label for="estado_ticket" :value="__('Estado del Ticket')" />
                            <select id="estado_ticket" name="estado_ticket" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                <option value="pendiente" {{ $ticket->estado_ticket == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en proceso" {{ $ticket->estado_ticket == 'en proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="resuelto" {{ $ticket->estado_ticket == 'resuelto' ? 'selected' : '' }}>Resuelto</option>
                                <option value="cerrado" {{ $ticket->estado_ticket == 'cerrado' ? 'selected' : '' }}>Cerrado</option>
                            </select>
                        </div>

                        <!-- Fecha de Resolución -->
                        <div class="col-span-1">
                            <x-label for="fecha_resolucion" :value="__('Fecha de Resolución')" />
                            <x-text-input id="fecha_resolucion" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                          type="date" name="fecha_resolucion" value="{{ $ticket->fecha_resolucion }}" />
                        </div>
                    </div>

                    <!-- Descripción del Ticket -->
                    <div class="mb-6">
                        <x-label for="descripcion" :value="__('Descripción')" />
                        <textarea id="descripcion" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                  name="descripcion" required 
                                  placeholder="Descripción del problema">{{ $ticket->descripcion }}</textarea>
                    </div>

                    <!-- Información Adicional -->
                    <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">{{ __('Información Adicional') }}</h4>

                    <!-- Observaciones -->
                    <div class="mb-6">
                        <x-label for="observaciones" :value="__('Observaciones')" />
                        <textarea id="observaciones" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                  name="observaciones" 
                                  placeholder="Observaciones adicionales">{{ $ticket->observaciones }}</textarea>
                    </div>

                    <!-- Confirmado por Usuario -->
                    <div class="mb-6">
                        <x-label for="confirmado_por_usuario" :value="__('Confirmado por Usuario')" />
                        <label class="inline-flex items-center">
                            <input id="confirmado_por_usuario" type="checkbox" name="confirmado_por_usuario" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:border-blue-500" {{ $ticket->confirmado_por_usuario ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Sí') }}</span>
                        </label>
                    </div>

                    <!-- Fecha de Confirmación -->
                    <div class="mb-6">
                        <x-label for="fecha_confirmacion" :value="__('Fecha de Confirmación')" />
                        <x-text-input id="fecha_confirmacion" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                      type="date" name="fecha_confirmacion" value="{{ $ticket->fecha_confirmacion }}" />
                    </div>

                    <!-- Usuario Asignado -->
                    <div class="mb-6">
                        <x-label for="id_usuario_asignado" :value="__('Usuario Asignado')" />
                        <select id="id_usuario_asignado" name="id_usuario_asignado" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $ticket->id_usuario_asignado == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dispositivo -->
                    <div class="mb-6">
                        <x-label for="id_dispositivo" :value="__('Dispositivo')" />
                        <select id="id_dispositivo" name="id_dispositivo" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            @foreach ($dispositivos as $dispositivo)
                                <option value="{{ $dispositivo->id }}" {{ $ticket->id_dispositivo == $dispositivo->id ? 'selected' : '' }}>{{ $dispositivo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón de Actualizar -->
                    <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700">
                        {{ __('Actualizar Ticket') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
