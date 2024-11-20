<x-app-layout>
    <!-- Navegación fija superior -->
        <x-navbar />

    <!-- Contenido principal del layout -->
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Tickets') }}
        </h2>
    </x-slot>

    <div class="flex flex-col min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 pt-16">
        <!-- Contenido principal -->
        <div class="flex-1 p-8">
            <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6">
                <!-- Campo de búsqueda -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Lista de Tickets</h3>
                    <form action="{{ route('tecnico.index') }}" method="GET" class="w-full md:w-1/3 mt-4 md:mt-0 flex">
                        <input type="text" name="search" id="search-input" placeholder="Buscar tickets..."
                               value="{{ request('search') }}" 
                               class="w-full p-3 rounded-l-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-[#00CFFF] transition duration-200">
                        <button type="submit" class="px-4 py-3 bg-[#00CFFF] text-white rounded-r-lg hover:bg-[#00B3CC] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#00CFFF]">
                            Buscar
                        </button>
                        @if(request('search'))
                        <a href="{{ route('tecnico.index') }}" class="ml-2 px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                            Limpiar
                        </a>
                        @endif
                    </form>
                </div>

                <!-- Tabla de tickets -->
                <div class="overflow-x-auto">
                    <table class="w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#00CFFF] to-[#00B3CC] text-white text-lg">
                                <th class="px-6 py-4 text-left font-semibold">N° Ticket</th>
                                <th class="px-6 py-4 text-left font-semibold">Fecha Creación</th>
                                <th class="px-6 py-4 text-left font-semibold">Estado</th>
                                <th class="px-6 py-4 text-left font-semibold">Prioridad</th>
                                <th class="px-6 py-4 text-left font-semibold">Título</th>
                                <th class="px-6 py-4 text-left font-semibold">Usuario Asignado</th>
                                <th class="px-6 py-4 text-left font-semibold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="ticket-table" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($tickets as $ticket)
                                <tr class="hover:bg-[#00CFFF]/10 dark:hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4 text-center">{{ $ticket->id_ticket }}</td>
                                    <td class="px-6 py-4 text-center">{{ $ticket->fecha_creacion->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $estadoClasses = [
                                                'pendiente' => 'bg-yellow-500 text-white',
                                                'en proceso' => 'bg-[#00CFFF] text-white',
                                                'resuelto' => 'bg-green-500 text-white',
                                                'cerrado' => 'bg-gray-500 text-white',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $estadoClasses[$ticket->estado_ticket] ?? 'bg-gray-500 text-white' }}">
                                            {{ ucfirst($ticket->estado_ticket) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ ucfirst($ticket->prioridad) }}</td>
                                    <td class="px-6 py-4">{{ $ticket->titulo }}</td>
                                    <td class="px-6 py-4 text-center">{{ $ticket->asignado->nombre ?? 'Sin asignar' }}</td>
                                    <td class="px-6 py-4 flex flex-col gap-2 items-center justify-center">
                                        <a href="{{ route('tecnico.detalle', $ticket->id_ticket) }}" class="w-3/4 text-center bg-[#00CFFF] hover:bg-[#00B3CC] text-white font-semibold py-1 px-4 rounded-md transition duration-150 shadow focus:outline-none">
                                            Ver
                                        </a>
                                        @if($ticket->estado_ticket == 'pendiente')
                                            <form action="{{ route('tecnico.tomar', $ticket->id_ticket) }}" method="POST" class="w-full text-center">
                                                @csrf
                                                <button type="submit" class="w-3/4 mx-auto bg-gray-300 hover:bg-gray-400 text-white font-semibold py-1 px-4 rounded-md transition duration-150 shadow focus:outline-none">
                                                    Tomar
                                                </button>
                                                
                                            </form>
                                        @endif

                                        <!-- Selector para Cambiar Estado del Equipo -->
                                        <form action="{{ route('tecnico.cambiarEstadoEquipo', $ticket->equipo->id_equipo) }}" method="POST" class="w-full text-center">
                                            @csrf
                                            @method('PUT')
                                            <select name="estado_equipo" class="w-3/4 mx-auto mt-2 p-2 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#00CFFF] text-xs" onchange="this.form.submit()">
                                                <option value="operativo" {{ $ticket->equipo->estado_equipo == 'operativo' ? 'selected' : '' }}>Operativo</option>
                                                <option value="en reparación" {{ $ticket->equipo->estado_equipo == 'en reparación' ? 'selected' : '' }}>En reparación</option>
                                                <option value="fuera de servicio" {{ $ticket->equipo->estado_equipo == 'fuera de servicio' ? 'selected' : '' }}>Fuera de servicio</option>
                                            </select>
                                        </form>

                                        <!-- Botón de Subir Evidencia -->
                                        <button onclick="openModal({{ $ticket->id_ticket }})" class="w-3/4 bg-[#00CFFF] hover:bg-[#00B3CC] text-white font-semibold py-1 px-4 rounded-md transition duration-150 shadow focus:outline-none mt-2">
                                            Subir Evidencia
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-6">
                    {{ $tickets->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Subida de Evidencia -->
    <div id="modal-evidencia" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Subir Evidencia</h3>
            <form id="form-evidencia" action="" method="POST" enctype="multipart/form-data" data-route="{{ route('tecnico.uploadEvidencia', ':ticketId') }}">
                @csrf
                <label for="archivo" class="block text-gray-700 dark:text-gray-300 mb-2">Archivo de Evidencia</label>
                <input type="file" name="archivo" id="archivo" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-gray-300" required>
                <button type="submit" class="mt-4 bg-[#00CFFF] hover:bg-[#00B3CC] text-white font-bold py-2 px-4 rounded w-full">
                    Subir Evidencia
                </button>
            </form>
            <button onclick="closeModal()" class="mt-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded w-full">
                Cerrar
            </button>
        </div>
    </div>

    <!-- SweetAlert2 para alertas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    timer: 3000
                });
            @endif
            @if(session('error'))
                Swal.fire({
                    title: 'Error',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    timer: 3000
                });
            @endif
        });

        function openModal(ticketId) {
            const form = document.getElementById('form-evidencia');
            const route = form.getAttribute('data-route');
            form.action = route.replace(':ticketId', ticketId);
            document.getElementById('modal-evidencia').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-evidencia').classList.add('hidden');
        }
    </script>
</x-app-layout>
