<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 space-y-6">
                    <!-- Mostrar las imágenes del equipo en un carrusel -->
                    <div class="mt-6">
                        @if($equipo->imagenesequipos->isNotEmpty())
                            <div class="relative">
                                <!-- Carrusel -->
                                <div id="carousel-inner" class="overflow-hidden relative w-full">
                                    <div class="flex transition-transform duration-500 ease-in-out" style="width: 150%;">
                                        @foreach ($equipo->imagenesequipos as $imagen)
                                            <div class="w-full flex-shrink-0 text-center">
                                                @if(in_array(pathinfo($imagen->ruta, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <img 
                                                        src="{{ $imagen->ruta }}" 
                                                        alt="{{ $imagen->nombre_archivo }}" 
                                                        class="mx-auto object-contain rounded-lg shadow-md"
                                                        style="max-height: 400px; width: auto;">
                                                @else
                                                    <a href="{{ $imagen->ruta }}" target="_blank" class="text-[#00CFFF] hover:underline block text-center mt-4">
                                                        {{ $imagen->nombre_archivo }} ({{ pathinfo($imagen->ruta, PATHINFO_EXTENSION) }})
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                    
                                <!-- Controles -->
                                <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-[#00CFFF] text-white p-2 rounded-full shadow-md hover:bg-[#009FCC] focus:ring focus:ring-blue-300">
                                    &#10094;
                                </button>
                                <button id="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-[#00CFFF] text-white p-2 rounded-full shadow-md hover:bg-[#009FCC] focus:ring focus:ring-blue-300">
                                    &#10095;
                                </button>
                            </div>
                        @else
                            <div class="text-gray-500">No hay imágenes disponibles para este equipo.</div>
                        @endif
                    </div>
                    
                    
                    

                    <!-- Información general del equipo -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Información General</h3>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Nombre:</strong> {{ $equipo->nombre_equipo }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Descripción:</strong> {{ $equipo->descripcion }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Número de Serie:</strong> {{ $equipo->numero_serie }}</p>
                        <p class="text-gray-600 dark:text-gray-300"><strong>Estado:</strong> {{ $equipo->estado_equipo }}</p>
                    </div>

                    <!-- Dispositivos asociados y sus accesorios -->
                    <div>
                        <ul class="mt-2 space-y-2">
                            @foreach($equipo->dispositivos as $dispositivo)
                                <li class="text-gray-600 dark:text-gray-300">
                                    <strong>{{ $dispositivo->tipo_dispositivo }}</strong>
                                    @if($dispositivo->accesorios && $dispositivo->accesorios->isNotEmpty())
                                        <ul class="ml-4 mt-1">
                                            @foreach($dispositivo->accesorios as $accesorio)
                                                <li>- {{ $accesorio->nombre_accesorio ?? 'Accesorio sin nombre' }} - {{ $accesorio->estado_accesorio ? 'Operativo' : 'No Operativo' }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="ml-4 text-sm text-gray-500">Sin accesorios</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Botón de regreso -->
                    <div>
                        <a href="{{ route('tecnico.equipos.gestion.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                            Volver a la Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Script para el carrusel -->
    <script>
document.addEventListener('DOMContentLoaded', () => {
    const carouselInner = document.querySelector('#carousel-inner .flex');
    if (!carouselInner) return; // Verifica si el elemento existe

    const slides = carouselInner.querySelectorAll('.flex-shrink-0');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const totalSlides = slides.length;

    if (totalSlides === 0) return; // Si no hay imágenes, no ejecutar el script

    let currentIndex = 0;

    // Asegurarse de que las imágenes sean visibles y ocupen espacio
    slides.forEach(slide => {
        slide.style.width = `${100 / totalSlides}%`;
        slide.style.flexShrink = "0";
    });

    // Inicializar el ancho total del carrusel
    carouselInner.style.width = `${totalSlides * 120}%`;

    // Función para actualizar la posición del carrusel
    const updateCarousel = () => {
        const offset = currentIndex * -55;
        carouselInner.style.transform = `translateX(${offset}%)`;
    };

    // Evento para el botón anterior
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalSlides - 1;
        updateCarousel();
    });

    // Evento para el botón siguiente
    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
        updateCarousel();
    });

    // Establecer la posición inicial
    updateCarousel();
});


       
    </script>
    
    
    
</x-app-layout>
