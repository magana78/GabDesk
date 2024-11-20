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
            <?php echo e(__('Detalles del Equipo')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 space-y-6">
                    <!-- Mostrar la imagen del equipo -->
                    <div class="mb-6">
                        <?php if($equipo->imagenesequipos->isNotEmpty()): ?>
                            <img src="<?php echo e(asset('storage/' . $equipo->imagenesequipos->first()->ruta)); ?>" alt="Imagen del equipo" class="w-full max-w-lg mx-auto object-contain rounded-lg shadow-md">
                        <?php else: ?>
                            <span class="text-gray-600 dark:text-gray-400">Sin Imagen</span>
                        <?php endif; ?>
                    </div>

                    <!-- Información general del equipo -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Información General</h3>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Nombre:</strong> <?php echo e($equipo->nombre_equipo); ?></p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Descripción:</strong> <?php echo e($equipo->descripcion); ?></p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Número de Serie:</strong> <?php echo e($equipo->numero_serie); ?></p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Estado:</strong> <?php echo e($equipo->estado_equipo); ?></p>
                    </div>

                    <!-- Dispositivos asociados y sus accesorios -->
                    <div>
                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200">Dispositivos del Equipo</h4>
                        <ul class="mt-2 space-y-2">
                            <?php $__currentLoopData = $equipo->dispositivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dispositivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="text-gray-600 dark:text-gray-300">
                                    <!-- Mostrar solo tipo de dispositivo -->
                                    <strong><?php echo e($dispositivo->tipo_dispositivo); ?></strong>
                                    <!-- Accesorios del dispositivo -->
                                    <?php if($dispositivo->accesorios && $dispositivo->accesorios->isNotEmpty()): ?>
                                        <ul class="ml-4 mt-1">
                                            <?php $__currentLoopData = $dispositivo->accesorios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accesorio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>- <?php echo e($accesorio->nombre_accesorio ?? 'Accesorio sin nombre'); ?> - <?php echo e($accesorio->estado_accesorio ? 'Operativo' : 'No Operativo'); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="ml-4 text-sm text-gray-500"></p>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <!-- Botón de regreso -->
                    <div>
                        <a href="<?php echo e(route('tecnico.equipos.gestion.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                            Volver a la Lista
                        </a>
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
<?php /**PATH C:\Users\IIVAN\Documents\GabDesk-laravel\resources\views/tecnico/equipos_gestion_show.blade.php ENDPATH**/ ?>