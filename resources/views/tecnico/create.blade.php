<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Nuevo Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <!-- Formulario para crear ticket -->
                    <form action="{{ route('tecnico.store') }}" method="POST">
                        @csrf

                        <!-- Campo Título -->
                        <div class="mb-4">
                            <x-input-label for="titulo" :value="__('Título del Ticket')" />
                            <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" required autofocus />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <!-- Campo Descripción -->
                        <div class="mb-4">
                            <x-input-label for="descripcion" :value="__('Descripción')" />
                            <textarea id="descripcion" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300" name="descripcion" required></textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Campo Prioridad -->
                        <div class="mb-4">
                            <x-input-label for="prioridad" :value="__('Prioridad')" />
                            <select id="prioridad" name="prioridad" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300">
                                <option value="baja">Baja</option>
                                <option value="media">Media</option>
                                <option value="alta">Alta</option>
                            </select>
                            <x-input-error :messages="$errors->get('prioridad')" class="mt-2" />
                        </div>

                        <!-- Campo Estado -->
                        <div class="mb-4">
                            <x-input-label for="estado_ticket" :value="__('Estado')" />
                            <select id="estado_ticket" name="estado_ticket" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300">
                                <option value="pendiente">Pendiente</option>
                                <option value="en proceso">En Proceso</option>
                                <option value="resuelto">Resuelto</option>
                                <option value="cerrado">Cerrado</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado_ticket')" class="mt-2" />
                        </div>

                        <!-- Campo Observaciones -->
                        <div class="mb-4">
                            <x-input-label for="observaciones" :value="__('Observaciones')" />
                            <textarea id="observaciones" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300" name="observaciones"></textarea>
                            <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
                        </div>

                        <!-- Campo Confirmado por Usuario -->
                        <div class="mb-4">
                            <x-input-label for="confirmado_por_usuario" :value="__('Confirmado por Usuario')" />
                            <select id="confirmado_por_usuario" name="confirmado_por_usuario" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300">
                                <option value="0">{{ __('No') }}</option>
                                <option value="1">{{ __('Sí') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('confirmado_por_usuario')" class="mt-2" />
                        </div>

                        <!-- Campo Fecha de Creación (Automática) -->
                        <div class="mb-4">
                            <x-input-label for="fecha_creacion" :value="__('Fecha de Creación')" />
                            <x-text-input id="fecha_creacion" class="block mt-1 w-full bg-gray-200" type="text" name="fecha_creacion" value="{{ now() }}" disabled />
                        </div>

                        <!-- Campo Fecha de Resolución -->
                        <div class="mb-4">
                            <x-input-label for="fecha_resolucion" :value="__('Fecha de Resolución')" />
                            <x-text-input id="fecha_resolucion" class="block mt-1 w-full" type="date" name="fecha_resolucion" />
                            <x-input-error :messages="$errors->get('fecha_resolucion')" class="mt-2" />
                        </div>

                        <!-- Campo Fecha de Confirmación -->
                        <div class="mb-4">
                            <x-input-label for="fecha_confirmacion" :value="__('Fecha de Confirmación')" />
                            <x-text-input id="fecha_confirmacion" class="block mt-1 w-full" type="date" name="fecha_confirmacion" />
                            <x-input-error :messages="$errors->get('fecha_confirmacion')" class="mt-2" />
                        </div>

                        <!-- Campo Usuario Reportante (Automático) -->
                        <div class="mb-4">
                            <x-input-label for="id_usuario_reportante" :value="__('Usuario Reportante')" />
                            <x-text-input id="id_usuario_reportante" class="block mt-1 w-full bg-gray-200" type="text" name="id_usuario_reportante" value="{{ Auth::user()->name }}" disabled />
                        </div>

                        <!-- Campo Usuario Asignado -->
                        <div class="mb-4">
                            <x-input-label for="id_usuario_asignado" :value="__('Asignar a Usuario')" />
                            <select id="id_usuario_asignado" name="id_usuario_asignado" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300">
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_usuario_asignado')" class="mt-2" />
                        </div>

                        <!-- Campo Dispositivo -->
                        <div class="mb-4">
                            <x-input-label for="id_dispositivo" :value="__('Dispositivo')" />
                            <select id="id_dispositivo" name="id_dispositivo" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300">
                                @foreach($dispositivos as $dispositivo)
                                    <option value="{{ $dispositivo->id }}">{{ $dispositivo->nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_dispositivo')" class="mt-2" />
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="mt-4">
                            <x-primary-button class="w-full justify-center">
                                {{ __('Crear Ticket') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
