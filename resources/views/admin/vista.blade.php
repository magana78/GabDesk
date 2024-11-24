<x-app-layout>
    <x-navbar />

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle del Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Información del Ticket -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 border bg-[#00CFFF] hover:bg-[#b5ecf3]">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Información del Ticket</h3>
                <p><strong>ID:</strong> {{ $ticket->id_ticket }}</p>
                <p><strong>Título:</strong> {{ $ticket->titulo }}</p>
                <p><strong>Descripción:</strong> {{ $ticket->descripcion }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($ticket->estado_ticket) }}</p>
                <p><strong>Prioridad:</strong> {{ ucfirst($ticket->prioridad) }}</p>
                <p><strong>Usuario Asignado:</strong> {{ $ticket->asignado->nombre ?? 'Sin asignar' }}</p>
                <p><strong>Fecha de Creación:</strong> {{ $ticket->fecha_creacion->format('d/m/Y') }}</p>

                  <!-- Mostrar información adicional de Departamento, Área, Ubicación y Cubículo -->
                    <!-- Mostrar información adicional relacionada con el usuario técnico -->
                    <div class="informacion-tecnico">
                        <div class="informacion-tecnico mt-6 p-6 bg-white shadow-lg rounded-lg border border-gray-300">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">Detalles del Usuario Asignado al Equipo</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600"><strong>Nombre:</strong></p>
                                    <p id="tecnico-nombre" class="text-lg text-gray-800 font-medium">Cargando...</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600"><strong>Email:</strong></p>
                                    <p id="tecnico-email" class="text-lg text-gray-800 font-medium">Cargando...</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600"><strong>Departamento:</strong></p>
                                    <p id="tecnico-departamento" class="text-lg text-gray-800 font-medium">Cargando...</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600"><strong>Área:</strong></p>
                                    <p id="tecnico-area" class="text-lg text-gray-800 font-medium">Cargando...</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600"><strong>Ubicación:</strong></p>
                                    <p id="tecnico-ubicacion" class="text-lg text-gray-800 font-medium">Cargando...</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600"><strong>Cubículo:</strong></p>
                                    <p id="tecnico-cubiculo" class="text-lg text-gray-800 font-medium">Cargando...</p>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    
            </div>

            @if($evidenciasCompletas->isNotEmpty())
            <!-- Carrusel para evidencias con ruta completa -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Evidencias con Ruta Completa</h3>
                <div id="carousel-completo" class="relative">
                    <div class="overflow-hidden">
                        <div id="carousel-inner-completo" class="flex transition-transform ease-in-out duration-500">
                            @foreach ($evidenciasCompletas as $index => $evidencia)
                                <div class="w-full flex-shrink-0 relative group {{ $index === 0 ? 'block' : 'hidden' }}">
                                    @if(in_array(pathinfo($evidencia->ruta, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img src="{{ $evidencia->ruta }}" alt="{{ $evidencia->nombre_archivo }}" class="w-full h-auto object-contain rounded-lg border border-[#00CFFF] max-h-[400px] mx-auto">
                                    @else
                                        <a href="{{ $evidencia->ruta }}" target="_blank" class="text-[#00CFFF] hover:underline block text-center mt-4">
                                            {{ $evidencia->nombre_archivo }} ({{ pathinfo($evidencia->ruta, PATHINFO_EXTENSION) }})
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Controles del carrusel -->
                    <button id="prev-completo" class="absolute top-1/2 left-0 transform -translate-y-1/2 px-4 py-2 bg-[#00CFFF] text-white rounded-full hover:bg-[#009FCC] focus:outline-none">‹</button>
                    <button id="next-completo" class="absolute top-1/2 right-0 transform -translate-y-1/2 px-4 py-2 bg-[#00CFFF] text-white rounded-full hover:bg-[#009FCC] focus:outline-none">›</button>
                </div>
            </div>
        @endif
        
        @if($evidenciasRelativas->isNotEmpty())
            <!-- Carrusel para evidencias con ruta relativa -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Evidencias con Ruta Relativa</h3>
                <div id="carousel-relativo" class="relative">
                    <div class="overflow-hidden">
                        <div id="carousel-inner-relativo" class="flex transition-transform ease-in-out duration-500">
                            @foreach ($evidenciasRelativas as $index => $evidencia)
                                <div class="w-full flex-shrink-0 relative group {{ $index === 0 ? 'block' : 'hidden' }}">
                                    @if(in_array(pathinfo($evidencia->ruta, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img src="{{ $evidencia->ruta }}" alt="{{ $evidencia->nombre_archivo }}" class="w-full h-auto object-contain rounded-lg border border-[#00CFFF] max-h-[400px] mx-auto">
                                    @else
                                        <a href="{{ $evidencia->ruta }}" target="_blank" class="text-[#00CFFF] hover:underline block text-center mt-4">
                                            {{ $evidencia->nombre_archivo }} ({{ pathinfo($evidencia->ruta, PATHINFO_EXTENSION) }})
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Controles del carrusel -->
                    <button id="prev-relativo" class="absolute top-1/2 left-0 transform -translate-y-1/2 px-4 py-2 bg-[#00CFFF] text-white rounded-full hover:bg-[#009FCC] focus:outline-none">‹</button>
                    <button id="next-relativo" class="absolute top-1/2 right-0 transform -translate-y-1/2 px-4 py-2 bg-[#00CFFF] text-white rounded-full hover:bg-[#009FCC] focus:outline-none">›</button>
                </div>
            </div>
        @endif
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                function initializeCarousel(carouselInnerId, prevButtonId, nextButtonId) {
                    const items = document.querySelectorAll(`${carouselInnerId} > div`);
                    let currentIndex = 0;
        
                    if (items.length === 0) return;
        
                    items.forEach((item, index) => {
                        item.style.display = index === 0 ? 'block' : 'none';
                    });
        
                    document.getElementById(prevButtonId).addEventListener('click', () => {
                        items[currentIndex].style.display = 'none';
                        currentIndex = (currentIndex === 0) ? items.length - 1 : currentIndex - 1;
                        items[currentIndex].style.display = 'block';
                    });
        
                    document.getElementById(nextButtonId).addEventListener('click', () => {
                        items[currentIndex].style.display = 'none';
                        currentIndex = (currentIndex === items.length - 1) ? 0 : currentIndex + 1;
                        items[currentIndex].style.display = 'block';
                    });
                }
        
                // Inicializar ambos carruseles
                initializeCarousel('#carousel-inner-completo', 'prev-completo', 'next-completo');
                initializeCarousel('#carousel-inner-relativo', 'prev-relativo', 'next-relativo');
            });
        </script>
            
         

            <!-- Formulario para agregar observación -->
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 border border-[#00CFFF]">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Agregar Observación</h3>
                <form id="observacion-form">
                    @csrf
                    <textarea 
                        name="observacion" 
                        id="observacion-input" 
                        placeholder="Añadir observación" 
                        class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#00CFFF]" 
                        required></textarea>
                    <button type="submit" class="bg-[#00CFFF] text-white p-2 mt-4 rounded-lg hover:bg-[#009FCC] transition">Guardar Observación</button>
                </form>
            </div>
            
            <!-- Mostrar observaciones anteriores -->
            <div id="observaciones-list" class="bg-gray-300 dark:bg-gray-800 shadow-lg sm:rounded-lg p-6 mt-6">
                <h3 class="text-2xl font-semibold mb-4 text-[#00CFFF]">Observaciones</h3>
                <div id="observaciones-content">
                    @foreach (explode("\n", $ticket->observaciones) as $observacion)
                        @php
                            // Separar observación y timestamp si existe
                            $observacionPartes = explode(" - ", $observacion, 2);
                        @endphp
                        <div class="bg-gray-300 hover:bg-gray-400 p-2 rounded-lg mb-2">
                            <p class="font-semibold">{{ $observacionPartes[0] ?? 'Sin usuario' }}</p>
                            <p>{{ $observacionPartes[1] ?? $observacion }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            
            </div>
        </div>
    </div>

<!-- Botón para cerrar el ticket -->
<div class="dark:bg-gray-800 shadow sm:rounded-lg p-6 flex justify-center">
    <form id="cerrar-ticket-form" data-ticket-id="{{ $ticket->id_ticket }}">
        @csrf
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

    fetch(`{{ route('admin.agregarObservacion', $ticket->id_ticket) }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ observacion }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al guardar la observación.');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const observacionesContent = document.getElementById('observaciones-content');
            const newObservacion = document.createElement('div');
            newObservacion.classList.add('bg-gray-300', 'hover:bg-gray-400', 'p-2', 'rounded-lg', 'mb-2');
            
            // Crear nombre de usuario y timestamp
            const observacionUsuario = document.createElement('p');
            observacionUsuario.classList.add('font-semibold');
            observacionUsuario.textContent = `${data.usuario || 'Sin usuario'} - ${data.timestamp}`;
            
            // Crear contenido de la observación
            const observacionTexto = document.createElement('p');
            observacionTexto.textContent = data.observacion;

            // Agregar contenido a la nueva observación
            newObservacion.appendChild(observacionUsuario);
            newObservacion.appendChild(observacionTexto);

            // Agregar nueva observación al contenedor
            observacionesContent.appendChild(newObservacion);

            // Limpia el campo de entrada de observaciones
            observacionInput.value = '';

            // Mostrar mensaje de éxito
            Swal.fire({
                title: '¡Observación guardada!',
                text: 'La observación se ha añadido exitosamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar',
                timer: 2000,
            });
        } else {
            throw new Error(data.error || 'Error desconocido.');
        }
    })
    .catch(error => {
        console.error('Error:', error);

        // Mostrar mensaje de error
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al guardar la observación.',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            timer: 3000,
        });
    });
});

document.getElementById('cerrar-ticket-btn').addEventListener('click', function () {
    const ticketId = document.getElementById('cerrar-ticket-form').dataset.ticketId;
    const token = document.querySelector('input[name="_token"]').value;

    // URL corregida
    fetch(`/admin/ticket/${ticketId}/cerrar`, { // Corrige la ruta para evitar repetición
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
                window.location.href = '/admin/dashboard'; // Ajusta la ruta al dashboard si es necesario
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
    const ticketId = "{{ $ticket->id_ticket }}"; // ID del ticket enviado desde el backend

    fetch(`/admin/obtener-informacion-soporte/${ticketId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Error al obtener la información del soporte.');
            }
            return response.json();
        })
        .then((data) => {
            if (data.error) {
                throw new Error(data.error);
            }

            // Verificar si hay datos del equipo
            const equipo = data.ticket.equipo;
            if (equipo && equipo.usuarios.length > 0) {
                const usuarioAsignado = equipo.usuarios[0]; // Usamos el primer usuario asignado

                // Extraer datos del nombre, email, departamento, cubículo, ubicación y área
                const nombre = usuarioAsignado.nombre || 'Sin Nombre';
                const email = usuarioAsignado.email || 'Sin Email';
                const departamento = usuarioAsignado.departamento?.nombre_departamento || 'Sin Departamento';
                const cubiculo = usuarioAsignado.cubiculo?.numero_cubiculo || 'Sin Cubículo';
                const ubicacion = usuarioAsignado.cubiculo?.ubicacione?.nombre_ubicacion || 'Sin Ubicación';
                const area = usuarioAsignado.cubiculo?.ubicacione?.area?.nombre_area || 'Sin Área';

                // Actualizar los campos en la vista
                document.getElementById('tecnico-nombre').textContent = nombre;
                document.getElementById('tecnico-email').textContent = email;
                document.getElementById('tecnico-departamento').textContent = departamento;
                document.getElementById('tecnico-area').textContent = area;
                document.getElementById('tecnico-ubicacion').textContent = ubicacion;
                document.getElementById('tecnico-cubiculo').textContent = cubiculo;
            } else {
                // Mostrar mensajes predeterminados si no hay datos
                document.getElementById('tecnico-nombre').textContent = 'Sin Nombre';
                document.getElementById('tecnico-email').textContent = 'Sin Email';
                document.getElementById('tecnico-departamento').textContent = 'Sin Departamento';
                document.getElementById('tecnico-area').textContent = 'Sin Área';
                document.getElementById('tecnico-ubicacion').textContent = 'Sin Ubicación';
                document.getElementById('tecnico-cubiculo').textContent = 'Sin Cubículo';
            }
        })
        .catch((error) => {
            console.error('Error:', error);

            // Mostrar mensajes de error
            document.getElementById('tecnico-nombre').textContent = 'Error al cargar';
            document.getElementById('tecnico-email').textContent = 'Error al cargar';
            document.getElementById('tecnico-departamento').textContent = 'Error al cargar';
            document.getElementById('tecnico-area').textContent = 'Error al cargar';
            document.getElementById('tecnico-ubicacion').textContent = 'Error al cargar';
            document.getElementById('tecnico-cubiculo').textContent = 'Error al cargar';
        });
});




    </script>
</x-app-layout>
