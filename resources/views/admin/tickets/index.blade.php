<x-app-layout>
    <x-navbar />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Campo de búsqueda -->
                <form action="{{ route('admin.tickets.index') }}" method="GET" class="mb-4">
                    <input type="text" name="search" placeholder="Buscar tickets..." 
                           value="{{ request('search') }}" 
                           class="w-full p-2 rounded-lg border border-gray-400 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#00CFFF]">
                    <button type="submit" class="bg-[#00CFFF] hover:bg-[#009FCC] text-white px-4 py-2 rounded-lg mt-2 transition duration-150">
                        Buscar
                    </button>
                </form>

                <!-- Tabla de tickets -->
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <thead class="bg-[#00CFFF] text-white">
                        <tr>
                            <th class="px-6 py-4">N° Ticket</th>
                            <th class="px-6 py-4">Título</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4">Prioridad</th>
                            <th class="px-6 py-4">Asignado a</th>
                            <th class="px-6 py-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr class="hover:bg-[#E0F7FF] dark:hover:bg-gray-700 transition duration-200">
                                <td class="border px-6 py-4 text-center">{{ $ticket->id_ticket }}</td>
                                <td class="border px-6 py-4">{{ $ticket->titulo }}</td>
                                <td id="estado-{{ $ticket->id_ticket }}" class="border px-6 py-4">{{ ucfirst($ticket->estado_ticket) }}</td>
                                <td class="border px-6 py-4">{{ ucfirst($ticket->prioridad) }}</td>
                                <td id="asignado-{{ $ticket->id_ticket }}" class="border px-6 py-4">{{ $ticket->asignado->nombre ?? 'Sin asignar' }}</td>
                                <td class="border px-6 py-4 flex space-x-2">
                                    <a href="{{ route('admin.tickets.vista', $ticket->id_ticket) }}" 
                                       class="bg-[#00CFFF] hover:bg-[#009FCC] text-white px-4 py-2 rounded transition duration-150">
                                        Ver
                                    </a>
                                    <button type="button" class="border-2 border-[#00CFFF]  text-[#00CFFF]  hover:text-[#009FCC]  px-4 py-2 rounded transition duration-150 cambiar-estado-btn" data-ticket-id="{{ $ticket->id_ticket }}">
                                        Cambiar Estado
                                    </button>
                                    <button type="button" class="bg-gray-300 hover:bg-gray-400 text-white px-4 py-2 rounded transition duration-150 asignar-btn" data-ticket-id="{{ $ticket->id_ticket }}">
                                        Asignar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modales -->
        <!-- Modal para cambiar estado -->
        <div id="modal-cambiar-estado" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-4 rounded shadow-lg relative">
                    <h2 class="text-lg font-semibold mb-2">Cambiar Estado del Ticket</h2>
                    <select id="nuevo-estado" class="w-full border rounded p-2 mb-2">
                        <option value="pendiente">Pendiente</option>
                        <option value="en proceso">En Proceso</option>
                        <option value="resuelto">Resuelto</option>
                        <option value="cerrado">Cerrado</option>
                    </select>
                    <button id="guardar-estado" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    <button id="cancelar-estado" class="text-gray-500 px-4 py-2">Cancelar</button>
                    <span class="absolute top-0 right-0 p-2 cursor-pointer text-gray-400 hover:text-gray-600" onclick="closeModal('modal-cambiar-estado')">✖</span>
                </div>
            </div>
        </div>

        <!-- Modal para asignar ticket -->
<!-- Modal para asignar ticket -->
<div id="modal-asignar-ticket" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-4 rounded shadow-lg relative">
            <h2 class="text-lg font-semibold mb-2">Asignar Ticket</h2>
            <select id="usuario-asignado" class="w-full border rounded p-2 mb-2">
                <!-- Llenado dinámico desde JavaScript -->
            </select>
            <div class="flex space-x-2 mt-4">
                <button id="guardar-asignacion" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                    Guardar
                </button>
                <button id="cancelar-asignacion" class="text-gray-500 px-4 py-2 rounded hover:bg-gray-100 transition">
                    Cancelar
                </button>
            </div>
            <span class="absolute top-0 right-0 p-2 cursor-pointer text-gray-400 hover:text-gray-600" onclick="closeModal('modal-asignar-ticket')">✖</span>
        </div>
    </div>
</div>


        <!-- SweetAlert2 y Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let ticketId = null;
        
                // Mostrar modales
                document.querySelectorAll('.cambiar-estado-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        ticketId = this.dataset.ticketId;
                        openModal('modal-cambiar-estado');
                    });
                });
        
                document.querySelectorAll('.asignar-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        ticketId = this.dataset.ticketId;
                        cargarUsuarios(); // Cargar usuarios antes de mostrar el modal
                        openModal('modal-asignar-ticket');
                    });
                });
        
                function cargarUsuarios() {
    fetch('/admin/usuarios/tecnicos') // Asegúrate de que la URL sea correcta
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener la lista de usuarios');
            }
            return response.json();
        })
        .then(data => {
            const select = document.getElementById('usuario-asignado');
            select.innerHTML = ''; // Limpiar opciones anteriores

            if (data.usuarios && data.usuarios.length > 0) {
                data.usuarios.forEach(usuario => {
                    const option = document.createElement('option');
                    // Cambia "id_usuario" a la clave correcta según tu respuesta JSON
                    option.value = usuario.id_usuario;
                    option.textContent = usuario.nombre;
                    select.appendChild(option);
                });
            } else {
                const option = document.createElement('option');
                option.textContent = 'No hay usuarios disponibles';
                option.disabled = true;
                select.appendChild(option);
            }
        })
        .catch(error => {
            console.error('Error al cargar los usuarios:', error);
            Swal.fire('Error', 'Hubo un problema al cargar los usuarios.', 'error');
        });
}

        
                // Guardar cambio de estado
                document.getElementById('guardar-estado').addEventListener('click', function() {
                    const nuevoEstado = document.getElementById('nuevo-estado').value;
                    if (!ticketId) {
                        Swal.fire('Error', 'Ticket no válido.', 'error');
                        return;
                    }
                    fetch(`/admin/tickets/tickets/${ticketId}/cambiarEstado`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ nuevoEstado: nuevoEstado })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Éxito!', data.message, 'success');
                            document.querySelector(`#estado-${ticketId}`).textContent = data.nuevoEstado;
                            closeModal('modal-cambiar-estado');
                        } else {
                            Swal.fire('Error', data.message || 'Hubo un problema al cambiar el estado.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Hubo un error al procesar la solicitud.', 'error');
                    });
                });
        
                // Guardar asignación
                document.getElementById('guardar-asignacion').addEventListener('click', function() {
                    const usuarioId = document.getElementById('usuario-asignado').value;
                    if (!usuarioId) {
                        Swal.fire('Error', 'Por favor, selecciona un usuario.', 'error');
                        return;
                    }
                    if (!ticketId) {
                        Swal.fire('Error', 'Ticket no válido.', 'error');
                        return;
                    }
                    fetch(`/admin/tickets/tickets/${ticketId}/asignar`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ usuario_id: usuarioId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('¡Éxito!', data.message, 'success');
                            document.querySelector(`#asignado-${ticketId}`).textContent = data.nuevoAsignado;
                            closeModal('modal-asignar-ticket');
                        } else {
                            Swal.fire('Error', data.message || 'Hubo un problema al asignar el usuario.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Hubo un error al procesar la solicitud.', 'error');
                    });
                });
        
                // Cerrar modales
                document.getElementById('cancelar-estado').addEventListener('click', () => closeModal('modal-cambiar-estado'));
                document.getElementById('cancelar-asignacion').addEventListener('click', () => closeModal('modal-asignar-ticket'));
        
                function openModal(modalId) {
                    document.getElementById(modalId).classList.remove('hidden');
                }
        
                function closeModal(modalId) {
                    document.getElementById(modalId).classList.add('hidden');
                }
            });
        </script>
        
        
    </div>
</x-app-layout>
