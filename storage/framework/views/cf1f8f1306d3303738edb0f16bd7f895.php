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

     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Detalle del Ticket')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Información del Ticket -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 border bg-[#00CFFF] hover:bg-[#b5ecf3]">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Información del Ticket</h3>
                <p><strong>ID:</strong> <?php echo e($ticket->id_ticket); ?></p>
                <p><strong>Título:</strong> <?php echo e($ticket->titulo); ?></p>
                <p><strong>Descripción:</strong> <?php echo e($ticket->descripcion); ?></p>
                <p><strong>Estado:</strong> <?php echo e(ucfirst($ticket->estado_ticket)); ?></p>
                <p><strong>Prioridad:</strong> <?php echo e(ucfirst($ticket->prioridad)); ?></p>
                <p><strong>Usuario Asignado:</strong> <?php echo e($ticket->asignado->nombre ?? 'Sin asignar'); ?></p>
                <p><strong>Fecha de Creación:</strong> <?php echo e($ticket->fecha_creacion->format('d/m/Y')); ?></p>

                  <!-- Mostrar información adicional de Departamento, Área, Ubicación y Cubículo -->
                    <!-- Mostrar información adicional relacionada con el usuario técnico -->
                    <div class="informacion-tecnico">
                        <p><strong>Departamento:</strong> <span id="tecnico-departamento">Cargando...</span></p>
                        <p><strong>Área:</strong> <span id="tecnico-area">Cargando...</span></p>
                        <p><strong>Ubicación:</strong> <span id="tecnico-ubicacion">Cargando...</span></p>
                        <p><strong>Cubículo:</strong> <span id="tecnico-cubiculo">Cargando...</span></p>
                    </div>
                    
            </div>

            <?php if($evidencias->isNotEmpty()): ?>
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Evidencias</h3>
                <div id="carousel" class="relative">
                    <div class="overflow-hidden">
                        <div id="carousel-inner" class="flex transition-transform ease-in-out duration-500">
                            <?php $__currentLoopData = $evidencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $evidencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="w-full flex-shrink-0 relative group <?php echo e($index === 0 ? 'block' : 'hidden'); ?>">
                                    <?php if(in_array($evidencia->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])): ?>
                                        <img src="<?php echo e($evidencia->ruta); ?>" alt="<?php echo e($evidencia->nombre_archivo); ?>" class="w-full h-auto object-contain rounded-lg border border-[#00CFFF] max-h-[400px] mx-auto">
                                    <?php else: ?>
                                        <a href="<?php echo e($evidencia->ruta); ?>" target="_blank" class="text-[#00CFFF] hover:underline block text-center mt-4">
                                            <?php echo e($evidencia->nombre_archivo); ?> (<?php echo e($evidencia->extension); ?>)
                                        </a>
                                    <?php endif; ?>
                                    <!-- Botón para eliminar con visibilidad condicional -->
                                    <form action="<?php echo e(route('tecnico.evidencias.delete', $evidencia->id_evidencia)); ?>" method="POST" class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-700 focus:outline-none">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <!-- Controles del carrusel -->
                    <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 px-4 py-2 bg-[#00CFFF] text-white rounded-full hover:bg-[#009FCC] focus:outline-none">‹</button>
                    <button id="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 px-4 py-2 bg-[#00CFFF] text-white rounded-full hover:bg-[#009FCC] focus:outline-none">›</button>
                </div>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const items = document.querySelectorAll('#carousel-inner > div');
                    let currentIndex = 0;
            
                    function showItem(index) {
                        items[currentIndex].classList.add('hidden');
                        currentIndex = (index + items.length) % items.length;
                        items[currentIndex].classList.remove('hidden');
                    }
            
                    document.getElementById('prev').addEventListener('click', () => showItem(currentIndex - 1));
                    document.getElementById('next').addEventListener('click', () => showItem(currentIndex + 1));
                });
            </script>
            <?php else: ?>
            <div class="bg-gray-300 dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Evidencias</h3>
                <p class="text-gray-500">No hay evidencias subidas para este ticket.</p>
            </div>
            <?php endif; ?>
            
         

            <!-- Formulario para agregar observación -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 border border-[#00CFFF]">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Agregar Observación</h3>
                <form id="observacion-form">
                    <?php echo csrf_field(); ?>
                    <textarea name="observacion" id="observacion-input" placeholder="Añadir observación" class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#00CFFF]" required></textarea>
                    <button type="submit" class="bg-[#00CFFF] text-white p-2 mt-4 rounded-lg hover:bg-[#009FCC] transition">Guardar Observación</button>
                </form>
            </div>

            <!-- Mostrar observaciones anteriores -->
            <div id="observaciones-list" class="bg-gray-300 dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Observaciones</h3>
                <div id="observaciones-content">
                    <?php $__currentLoopData = explode("\n", $ticket->observaciones); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $observacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><?php echo e($observacion); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

<!-- Botón para cerrar el ticket -->
<div class="dark:bg-gray-800 shadow sm:rounded-lg p-6 flex justify-center">
    <form id="cerrar-ticket-form" data-ticket-id="<?php echo e($ticket->id_ticket); ?>">
        <?php echo csrf_field(); ?>
        <!-- Botón de tipo 'button' para evitar envío de formulario por defecto -->
        <button type="button" id="cerrar-ticket-btn" class="bg-red-500 text-white p-2 rounded hover:bg-red-700 transition-all duration-200">
            Cerrar Ticket
        </button>
    </form>
</div>




    <!-- SweetAlert2 para alertas de éxito/error -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if(session('success')): ?>
                Swal.fire({
                    title: '¡Éxito!',
                    text: "<?php echo e(session('success')); ?>",
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    timer: 3000
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                Swal.fire({
                    title: 'Error',
                    text: "<?php echo e(session('error')); ?>",
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    timer: 3000
                });
            <?php endif; ?>

            // Carrusel
            let currentIndex = 0;
            const items = document.querySelectorAll('#carousel-inner > div');
            const totalItems = items.length;

            document.getElementById('prev').addEventListener('click', () => {
                currentIndex = (currentIndex === 0) ? totalItems - 1 : currentIndex - 1;
                updateCarousel();
            });

            document.getElementById('next').addEventListener('click', () => {
                currentIndex = (currentIndex === totalItems - 1) ? 0 : currentIndex + 1;
                updateCarousel();
            });

            function updateCarousel() {
                const width = items[0].clientWidth;
                document.getElementById('carousel-inner').style.transform = `translateX(-${currentIndex * width}px)`;
            }
        });

        // Manejo de AJAX para agregar observación
        document.getElementById('observacion-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const observacionInput = document.getElementById('observacion-input');
            const observacion = observacionInput.value;
            const token = document.querySelector('input[name="_token"]').value;

            fetch(`<?php echo e(route('tecnico.agregarObservacion', $ticket->id_ticket)); ?>`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({ observacion: observacion }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const observacionesContent = document.getElementById('observaciones-content');
                    const newObservacion = document.createElement('p');
                    newObservacion.classList.add('text-gray-600', 'dark:text-gray-400', 'mb-2');
                    newObservacion.textContent = `${data.observacion} (${data.timestamp})`;
                    observacionesContent.appendChild(newObservacion);

                    // Limpia el campo de entrada de observaciones
                    observacionInput.value = '';

                    // Muestra un mensaje de éxito
                    Swal.fire({
                        title: '¡Observación guardada!',
                        text: 'La observación se ha añadido exitosamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        timer: 2000
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.error,
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        timer: 3000
                    });
                }
            })
            .catch(error => console.error('Error:', error));
        });
document.getElementById('cerrar-ticket-btn').addEventListener('click', function () {
    const ticketId = document.getElementById('cerrar-ticket-form').dataset.ticketId;
    const token = document.querySelector('input[name="_token"]').value;

    // URL corregida
    fetch(`/tecnico/ticket/${ticketId}/cerrar`, { // Corrige la ruta para evitar repetición
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify({})
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: '¡Ticket Cerrado!',
                text: 'El ticket se ha cerrado exitosamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                timer: 3000
            }).then(() => {
                // Redirige al dashboard del técnico
                window.location.href = '/tecnico/dashboard'; // Ajusta la ruta al dashboard si es necesario
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: data.message || 'Hubo un problema al cerrar el ticket.',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                timer: 3000
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'Hubo un error al procesar la solicitud.',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Supongamos que tienes una ruta para obtener la información del técnico de soporte asignado
    fetch('/tecnico/obtener-informacion-soporte', { // Ajusta la ruta según sea necesario
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al obtener la información del técnico de soporte.');
        }
        return response.json();
    })
    .then(data => {
    // Asignar la información obtenida a los campos correspondientes
    document.getElementById('tecnico-departamento').textContent = data.departamento !== undefined ? data.departamento : 'N/A';
    document.getElementById('tecnico-area').textContent = data.area !== undefined ? data.area : 'N/A';
    document.getElementById('tecnico-ubicacion').textContent = data.ubicacion !== undefined ? data.ubicacion : 'N/A';
    document.getElementById('tecnico-cubiculo').textContent = data.cubiculo !== undefined ? data.cubiculo : 'N/A';
})

    .catch(error => {
        console.error('Error:', error);
        document.getElementById('tecnico-departamento').textContent = 'Error al cargar';
        document.getElementById('tecnico-area').textContent = 'Error al cargar';
        document.getElementById('tecnico-ubicacion').textContent = 'Error al cargar';
        document.getElementById('tecnico-cubiculo').textContent = 'Error al cargar';
    });
});

        // Manejo de observaciones y cierre de ticket (código original)




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
<?php /**PATH C:\Users\IIVAN\Documents\GabDesk-laravel\resources\views/tecnico/show.blade.php ENDPATH**/ ?>