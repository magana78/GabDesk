<!-- resources/views/components/navbar.blade.php -->
<nav x-data="{ open: false }" class="bg-white border-b border-gray-300 fixed top-0 w-full z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo dinámico según el rol -->
                <div class="shrink-0 flex items-center">
                    <?php if(Auth::user()->hasRole('Administrador')): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-600 font-bold text-lg">
                            <img src="<?php echo e(asset('img/Gabdesk.png')); ?>" class="h-9 w-auto" alt="Logo Gabdesk">
                        </a>
                    <?php elseif(Auth::user()->hasRole('Técnico de soporte')): ?>
                        <a href="<?php echo e(route('tecnico.dashboard')); ?>" class="text-blue-600 font-bold text-lg">
                            <img src="<?php echo e(asset('img/Gabdesk.png')); ?>" class="h-9 w-auto" alt="Logo Gabdesk">
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Enlaces de navegación según el rol -->
                <div class="hidden md:flex space-x-8 ml-10">
                    <?php if(Auth::user()->hasRole('Administrador')): ?>
                        <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('admin.dashboard'),'active' => request()->routeIs('admin.dashboard'),'class' => 'text-gray-600 hover:text-blue-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('admin.dashboard')),'class' => 'text-gray-600 hover:text-blue-600']); ?>
                            <?php echo e(__('Dashboard de Administración')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
                    <?php elseif(Auth::user()->hasRole('Técnico de soporte')): ?>
                        <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['href' => route('tecnico.dashboard'),'active' => request()->routeIs('tecnico.dashboard'),'class' => 'text-gray-600 hover:text-blue-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('tecnico.dashboard')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('tecnico.dashboard')),'class' => 'text-gray-600 hover:text-blue-600']); ?>
                            <?php echo e(__('Dashboard Técnico de Soporte')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Dropdown de configuración -->
            <?php if (isset($component)) { $__componentOriginal3d494dd69b5219856093d533f0126b56 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d494dd69b5219856093d533f0126b56 = $attributes; } ?>
<?php $component = App\View\Components\UserSettingsDropdown::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-settings-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\UserSettingsDropdown::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => 'right']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d494dd69b5219856093d533f0126b56)): ?>
<?php $attributes = $__attributesOriginal3d494dd69b5219856093d533f0126b56; ?>
<?php unset($__attributesOriginal3d494dd69b5219856093d533f0126b56); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d494dd69b5219856093d533f0126b56)): ?>
<?php $component = $__componentOriginal3d494dd69b5219856093d533f0126b56; ?>
<?php unset($__componentOriginal3d494dd69b5219856093d533f0126b56); ?>
<?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH C:\Users\IIVAN\Documents\GabDesk-laravel\resources\views/components/navbar.blade.php ENDPATH**/ ?>