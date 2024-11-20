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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Gestión de Equipos')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <a href="<?php echo e(route('tecnico.equipos.gestion.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mb-4 inline-block">
                        Crear Nuevo Equipo
                    </a>

                    <div class="mt-6">
                        <?php if($equipos->isEmpty()): ?>
                            <p class="text-gray-600 dark:text-gray-300">No hay equipos agregados aún. Los equipos nuevos aparecerán aquí.</p>
                        <?php else: ?>
                            <table class="min-w-full bg-gray-100 dark:bg-gray-900 rounded-lg">
                                <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Imagen</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Nombre del Equipo</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Descripción</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Número de Serie</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Dispositivos</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Usuario Asignado</th>
                                    <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-semibold">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $equipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-b border-gray-300 dark:border-gray-700">
                                        <!-- Columna de Imagen -->
                                        <td class="px-4 py-2">
                                            <?php if($equipo->imagenesequipos->isNotEmpty()): ?>
                                                <img src="<?php echo e(asset('storage/' . $equipo->imagenesequipos->first()->ruta)); ?>" alt="Imagen del equipo" class="w-16 h-16 object-cover rounded-lg">
                                            <?php else: ?>
                                                <span class="text-gray-600 dark:text-gray-400">Sin Imagen</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Nombre del Equipo -->
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-200"><?php echo e($equipo->nombre_equipo); ?></td>
                                        <!-- Descripción -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300"><?php echo e($equipo->descripcion); ?></td>
                                        <!-- Número de Serie -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300"><?php echo e($equipo->numero_serie); ?></td>
                                        <!-- Dispositivos -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                            <?php if($equipo->dispositivos->isNotEmpty()): ?>
                                                <ul>
                                                    <?php $__currentLoopData = $equipo->dispositivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dispositivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($dispositivo->tipo_dispositivo); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php else: ?>
                                                Sin Dispositivos
                                            <?php endif; ?>
                                        </td>
                                        <!-- Usuario Asignado -->
                                        <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                            <?php echo e($equipo->usuario ? $equipo->usuario->nombre : 'No asignado'); ?>

                                        </td>
                                        <!-- Acciones -->
                                        <td class="px-4 py-2 flex space-x-2">
                                            <!-- Botón de Ver Detalles -->
                                            <a href="<?php echo e(route('tecnico.equipos_gestion_show', $equipo->id_equipo)); ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                                Ver Detalles
                                            </a>
                                            <a href="<?php echo e(route('tecnico.equipos.gestion.addImage', $equipo)); ?>" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                                <?php echo e($equipo->imagenesequipos->isEmpty() ? 'Agregar Foto' : 'Actualizar Foto'); ?>

                                            </a>
                                            <a href="<?php echo e(route('tecnico.equipos.gestion.assignUser', $equipo)); ?>" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                                <?php echo e($equipo->usuario ? 'Cambiar Usuario' : 'Asignar Usuario'); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <!-- Enlaces de paginación -->
                            <div class="mt-6">
                                <?php echo e($equipos->links()); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<?php /**PATH C:\Users\IIVAN\Documents\GabDesk-laravel\resources\views/tecnico/equipos_gestion_index.blade.php ENDPATH**/ ?>