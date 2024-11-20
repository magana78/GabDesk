<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Barra de navegación superior -->
    <?php if (isset($component)) { $__componentOriginalb9eddf53444261b5c229e9d8b9f1298e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e = $attributes; } ?>
<?php $component = App\View\Components\Navbar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Navbar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e)): ?>
<?php $attributes = $__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e; ?>
<?php unset($__attributesOriginalb9eddf53444261b5c229e9d8b9f1298e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb9eddf53444261b5c229e9d8b9f1298e)): ?>
<?php $component = $__componentOriginalb9eddf53444261b5c229e9d8b9f1298e; ?>
<?php unset($__componentOriginalb9eddf53444261b5c229e9d8b9f1298e); ?>
<?php endif; ?>

    <!-- Contenido principal del layout -->
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center mb-4">
            <?php echo e(__('Panel de Administración')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

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
                    <button class="bg-[#00CFFF] hover:bg-[#009FCC] text-white px-4 py-2 rounded-lg transition duration-150">
                        Crear nuevo
                    </button>
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-150">
                        Configuración
                    </button>
                </div>
            </div>

            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Técnicos</h4>
                        <p class="text-gray-600 dark:text-gray-400">Administra a los técnicos</p>
                    </div>
                    <div class="text-[#00CFFF] text-4xl font-bold">
                        <?php echo e($totalTecnicos); ?>


                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Tickets</h4>
                        <p class="text-gray-600 dark:text-gray-400">Total de tickets registrados</p>
                    </div>
                    <div class="text-[#00CFFF] text-4xl font-bold">
                        <?php echo e($totalTickets); ?>

                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Reportes</h4>
                        <p class="text-gray-600 dark:text-gray-400">Visualiza estadísticas</p>
                    </div>
                    <div class="text-[#00CFFF] text-4xl font-bold">
                        8
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
                                <td class="p-4">Tickets</td>
                                <td class="p-4">Consulta y gestiona todos los tickets del sistema</td>
                                <td class="p-4">
                                    <a href="<?php echo e(route('admin.tickets.index')); ?>" class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-bold py-1 px-3 rounded-lg transition duration-150">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-[#E0F7FF] dark:hover:bg-gray-700 transition duration-200">
                                <td class="p-4">Registro de Usuario</td>
                                <td class="p-4">Registra nuevos usuarios en el sistema</td>
                                <td class="p-4">
                                    <a href="<?php echo e(route('admin.register')); ?>" class="bg-[#00CFFF] hover:bg-[#009FCC] text-white font-bold py-1 px-3 rounded-lg transition duration-150">
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
            url: "<?php echo e(route('admin.tickets.data')); ?>", // Ruta de tu controlador que devuelve los datos
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\IIVAN\Documents\GabDesk-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>