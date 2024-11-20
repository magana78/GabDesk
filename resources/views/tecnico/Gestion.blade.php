<x-app-layout>
    <!-- Contenido principal del layout -->
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight text-center mb-8">
            {{ __('Gestión de Tickets') }}
        </h2>
    </x-slot>

    <div class="flex flex-col items-center min-h-screen bg-gradient-to-br from-gray-50 to-gray-200 dark:from-gray-900 dark:to-gray-800 pt-8">
        <!-- Filtro de Estado en la parte superior -->
        <div class="w-full max-w-6xl bg-white dark:bg-gray-800 rounded-lg shadow-md mb-6">
            <ul id="filter-tabs" class="flex justify-between py-3 bg-gradient-to-r from-[#00CFFF] to-[#00CFFF] text-white rounded-t-lg">
                <li>
                    <button data-estado="" onclick="filterTickets('')" class="filter-button font-semibold py-2 px-6 hover:bg-[#87CFFF] rounded transition-all duration-300 focus:outline-none">
                        {{ __('Todos') }}
                    </button>
                </li>
                <li>
                    <button data-estado="pendiente" onclick="filterTickets('pendiente')" class="filter-button font-semibold py-2 px-6 hover:bg-[#87CFFF] rounded transition-all duration-300 focus:outline-none">
                        {{ __('Pendiente') }}
                    </button>
                </li>
                <li>
                    <button data-estado="en proceso" onclick="filterTickets('en proceso')" class="filter-button font-semibold py-2 px-6 hover:bg-[#87CFFF] rounded transition-all duration-300 focus:outline-none">
                        {{ __('En Proceso') }}
                    </button>
                </li>
                <li>
                    <button data-estado="resuelto" onclick="filterTickets('resuelto')" class="filter-button font-semibold py-2 px-6 hover:bg-[#87CFFF] rounded transition-all duration-300 focus:outline-none">
                        {{ __('Resuelto') }}
                    </button>
                </li>
                <li>
                    <button data-estado="cerrado" onclick="filterTickets('cerrado')" class="filter-button font-semibold py-2 px-6 hover:bg-[#87CFFF] rounded transition-all duration-300 focus:outline-none">
                        {{ __('Cerrado') }}
                    </button>
                </li>
            </ul>
        </div>

        <!-- Espacio de Contenido Principal -->
        <div class="w-full max-w-6xl bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <p class="text-center text-gray-600 dark:text-gray-400 mb-4">
                Selecciona una opción de filtro para ver los tickets correspondientes.
            </p>
            <!-- Aquí se mostrará el contenido filtrado -->
            <div id="filtered-tickets" class="mt-4 space-y-4">
                <!-- Contenido de tickets filtrados por AJAX irá aquí -->
            </div>
        </div>
    </div>

    <script>
        // Función para filtrar tickets y actualizar la interfaz
        function filterTickets(estado = '') {
            // Realiza la petición fetch para filtrar los tickets
            fetch(`/tecnico/filter/${estado}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    const ticketContainer = document.getElementById('filtered-tickets');
                    ticketContainer.innerHTML = ''; // Limpiar contenido previo

                    if (data.tickets && data.tickets.length > 0) {
                        data.tickets.forEach(ticket => {
                            ticketContainer.innerHTML += `
                                <div class="bg-gradient-to-r from-[#E0F7FF] to-white dark:from-gray-700 dark:to-gray-800 p-4 rounded-lg shadow-lg">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">${ticket.titulo}</h3>
                                    <p class="text-gray-600 dark:text-gray-300">Estado: <span class="font-semibold text-${ticket.estado_ticket === 'pendiente' ? 'yellow' : ticket.estado_ticket === 'en proceso' ? 'blue' : ticket.estado_ticket === 'resuelto' ? 'green' : 'gray'}-500">${ticket.estado_ticket}</span></p>
                                    <p class="text-gray-600 dark:text-gray-300">Prioridad: <span class="font-semibold capitalize">${ticket.prioridad}</span></p>
                                    <p class="text-gray-600 dark:text-gray-300">Usuario Asignado: <span class="font-semibold">${ticket.asignado ? ticket.asignado.nombre : 'Sin asignar'}</span></p>
                                    <div class="mt-2">
                                        <a href="/tecnico/tickets/${ticket.id_ticket}" class="text-[#00A0C6] hover:text-[#008BBB] dark:text-[#00A0C6] hover:underline">Ver</a>
                                        @if (!auth()->user() || !auth()->user()->hasRole('Tecnico de Soporte'))
                                            <a href="/tecnico/cambiarEstado/${ticket.id_ticket}" class="ml-4 text-yellow-600 hover:text-yellow-700 dark:text-yellow-400 hover:underline">Cambiar Estado</a>
                                        @endif                                  
                                        
                                        </div>
                                </div>
                            `;
                        });
                    } else {
                        ticketContainer.innerHTML = `
                            <p class="text-center text-gray-500 dark:text-gray-400">No hay tickets en este estado.</p>
                        `;
                    }

                    // Actualiza el botón activo
                    updateActiveTab(estado);
                })
                .catch(error => {
                    console.error('Error al cargar los tickets:', error);
                    document.getElementById('filtered-tickets').innerHTML = `
                        <p class="text-center text-red-500 dark:text-red-400">Error al cargar los tickets.</p>
                    `;
                });
        }

        // Función para actualizar el estado activo del botón de filtro
        function updateActiveTab(estado) {
            const buttons = document.querySelectorAll('.filter-button');
            buttons.forEach(button => {
                if (button.getAttribute('data-estado') === estado) {
                    button.classList.add('bg-white', 'text-[#00A0C6]');
                    button.classList.remove('hover:bg-[#87CFFF]');
                } else {
                    button.classList.remove('bg-white', 'text-[#00A0C6]');
                    button.classList.add('hover:bg-[#87CFFF]');
                }
            });
        }
    </script>
</x-app-layout>
