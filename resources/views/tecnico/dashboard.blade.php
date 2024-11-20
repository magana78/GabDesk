<x-app-layout>
    <!-- Barra de navegación superior -->
    <x-navbar />

    <!-- Contenido principal del dashboard del técnico -->
    <div class="py-20 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de bienvenida -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-6 p-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-2">¡Bienvenido, Técnico de Soporte!</h2>
                <p class="text-gray-600 dark:text-gray-400">Desde aquí puedes gestionar tus tickets y mantener un seguimiento de las tareas asignadas.</p>
            </div>

            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div id="totalTicketsCard" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex items-center">
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Tickets Totales</h4>
                        <p id="totalTickets" class="text-3xl font-bold text-blue-500">Cargando...</p>
                    </div>
                </div>
                <div id="pendingTicketsCard" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex items-center">
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Tickets Pendientes</h4>
                        <p id="pendingTickets" class="text-3xl font-bold text-yellow-500">Cargando...</p>
                    </div>
                </div>
                <div id="inProgressTicketsCard" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex items-center">
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Tickets en Proceso</h4>
                        <p id="inProgressTickets" class="text-3xl font-bold text-blue-400">Cargando...</p>
                    </div>
                </div>
                <div id="resolvedTicketsCard" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 flex items-center">
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Tickets Resueltos</h4>
                        <p id="resolvedTickets" class="text-3xl font-bold text-green-500">Cargando...</p>
                    </div>
                </div>
            </div>

            <!-- Gestión de Tickets -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-6 p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Gestión de Tickets</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('tecnico.index') }}" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 rounded-lg shadow-lg">
                        Ver Todos los Tickets
                    </a>
                    <a href="{{ route('tecnico.carteras.filtrar') }}" class="flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-lg shadow-lg">
                        Carteras
                    </a>
                    <a href="{{ route('tecnico.filterByState', 'resuelto') }}" class="flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 rounded-lg shadow-lg">
                        Ver Tickets Resueltos
                    </a>
                    <!-- Nuevo enlace para equipos -->
                    <a href="{{ route('tecnico.equipos.gestion.index') }}" class="flex items-center justify-center bg-purple-500 hover:bg-purple-600 text-white font-bold py-4 rounded-lg shadow-lg">
                        Gestionar Equipos
                    </a>
                </div>
            </div>

            <!-- Estadísticas de Tickets con Gráfico -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Estadísticas de Tickets</h3>
                <canvas id="ticketChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Script para el gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Realizar una solicitud AJAX para obtener los datos del gráfico
            $.ajax({
                url: "{{ route('tecnico.tickets.data') }}", // Ruta de tu controlador que devuelve los datos
                method: 'GET',
                success: function(data) {
                    // Configuración del gráfico
                    const ctx = document.getElementById('ticketChart').getContext('2d');
                    const ticketData = {
                        labels: ['Pendiente', 'En Proceso', 'Resuelto', 'Cerrado'],
                        datasets: [{
                            label: 'Número de Tickets',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(153, 102, 255, 0.5)'
                            ],
                            borderColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    };

                    const config = {
                        type: 'bar',
                        data: ticketData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    };

                    // Inicializa el gráfico
                    new Chart(ctx, config);
                },
                error: function() {
                    console.error('Error al obtener los datos del gráfico.');
                }
            });
        });

        $(document).ready(function () {
            // Obtener estadísticas de tickets a través de AJAX
            $.ajax({
                url: "{{ route('tecnico.tickets.statistics') }}",
                method: 'GET',
                success: function (data) {
                    $('#totalTickets').text(data.pending + data.in_progress + data.resolved + data.closed);
                    $('#pendingTickets').text(data.pending);
                    $('#inProgressTickets').text(data.in_progress);
                    $('#resolvedTickets').text(data.resolved);
                },
                error: function () {
                    console.error('Error al obtener las estadísticas de los tickets.');
                    $('#totalTickets, #pendingTickets, #inProgressTickets, #resolvedTickets').text('Error');
                }
            });
        });
    </script>
</x-app-layout>
