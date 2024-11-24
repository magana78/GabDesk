<x-app-layout>
    <!-- Barra de navegación superior -->
    <x-navbar />

    <!-- Contenido principal del layout -->
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center mb-4">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <!-- Contenido principal -->
    <div class="p-6 lg:p-8 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Bienvenida -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Bienvenido al Panel de Administración</h3>
                    <p class="text-gray-600 dark:text-gray-400">Desde aquí puedes gestionar técnicos, tickets y visualizar estadísticas del sistema.</p>
                </div>
                <div class="flex items-center space-x-4">
                
                </div>
            </div>

            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Técnicos</h4>
                        <p class="text-gray-600 dark:text-gray-400">Administra a los técnicos</p>
                    </div>
                    <div class="text-[#00CFFF] text-4xl font-bold">
                        {{ $totalTecnicos }}

                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Tickets</h4>
                        <p class="text-gray-600 dark:text-gray-400">Total de tickets registrados</p>
                    </div>
                    <div class="text-[#00CFFF] text-4xl font-bold">
                        {{ $totalTickets }}
                    </div>
                </div>
            
            </div>

            <!-- Tabla de gestión -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Gestión de Secciones</h3>
                <div class="overflow-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow">
                        <thead class="bg-[#00CFFF] text-white ">
                            <tr>
                                <th class="p-4 text-left">Sección</th>
                                <th class="p-4 text-left">Descripción</th>
                                <th class="p-4 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-[#E0F7FF] dark:hover:bg-gray-700 transition duration-200">
                                <td class="p-4">Gestión de Reportes</td>
                                <td class="p-4">Administra los Reportes del sistema</td>
                                <td class="p-4">
                                    <a href="{{ route('admin.reportes.ticketsResueltos') }}" 
                                       class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-bold py-1 px-3 rounded-lg transition duration-150">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-[#E0F7FF] dark:hover:bg-gray-700 transition duration-200">
                                <td class="p-4">Gestión de Reportes Usuario</td>
                                <td class="p-4">Administra los Reportes del sistema</td>
                                <td class="p-4">
                                    <a href="{{ route('admin.reportes.ticketsPorUsuario') }}" 
                                       class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-bold py-1 px-3 rounded-lg transition duration-150">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-[#E0F7FF] dark:hover:bg-gray-700 transition duration-200">
                                <td class="p-4">Tickets</td>
                                <td class="p-4">Consulta y gestiona todos los tickets del sistema</td>
                                <td class="p-4">
                                    <a href="{{ route('admin.tickets.index') }}" class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-bold py-1 px-3 rounded-lg transition duration-150">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-[#E0F7FF] dark:hover:bg-gray-700 transition duration-200">
                                <td class="p-4">Registro de Usuario</td>
                                <td class="p-4">Registra nuevos usuarios en el sistema</td>
                                <td class="p-4">
                                    <a href="{{ route('admin.register') }}" class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-bold py-1 px-3 rounded-lg transition duration-150">
                                        Ver
                                    </a>
                                </td>
                        </tbody>
                    </table>
                </div>
            </div>

               <!-- Contenedor para el gráfico -->
<div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden p-6">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Estadísticas de Tickets</h3>
    <canvas id="ticketChart"></canvas>
</div>

<!-- Script para el gráfico -->
<<!-- Script para el gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery para la solicitud AJAX -->
<script>
    $(document).ready(function() {
        // Realizar una solicitud AJAX para obtener los datos del gráfico
        $.ajax({
            url: "{{ route('admin.tickets.data') }}", // Ruta de tu controlador que devuelve los datos
            method: 'GET',
            success: function(data) {
                console.log('Datos recibidos para el gráfico:', data); // Depuración

                // Verificar si los datos son válidos antes de crear el gráfico
                if (Array.isArray(data)) {
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
                } else {
                    console.error('Datos inválidos recibidos para el gráfico.');
                }
            },
            error: function() {
                console.error('Error al obtener los datos del gráfico.');
            }
        });
    });
</script>
</x-app-layout>
