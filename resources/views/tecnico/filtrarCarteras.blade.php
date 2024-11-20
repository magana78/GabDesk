<x-app-layout>
    <!-- Barra de navegación superior -->
    <x-navbar />

    <!-- Contenido principal del filtro -->
    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sección de Filtro -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-6 p-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Filtrar Información</h2>

                <!-- Select de Departamentos -->
                <div class="mb-4">
                    <label for="departamento" class="block mb-2 text-gray-700">Departamento</label>
                    <select id="departamento" class="w-full p-3 border rounded-lg bg-gray-50 hover:bg-white transition">
                        <option value="">Seleccione un Departamento</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id_departamento }}">{{ $departamento->nombre_departamento }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select de Áreas -->
                <div class="mb-4">
                    <label for="area" class="block mb-2 text-gray-700">Área</label>
                    <select id="area" class="w-full p-3 border rounded-lg bg-gray-50 hover:bg-white transition" disabled>
                        <option value="">Seleccione un Área</option>
                    </select>
                </div>

                <!-- Select de Ubicaciones -->
                <div class="mb-4">
                    <label for="ubicacion" class="block mb-2 text-gray-700">Ubicación</label>
                    <select id="ubicacion" class="w-full p-3 border rounded-lg bg-gray-50 hover:bg-white transition" disabled>
                        <option value="">Seleccione una Ubicación</option>
                    </select>
                </div>

                <!-- Select de Cubículos -->
                <div class="mb-4">
                    <label for="cubiculo" class="block mb-2 text-gray-700">Cubículo</label>
                    <select id="cubiculo" class="w-full p-3 border rounded-lg bg-gray-50 hover:bg-white transition" disabled>
                        <option value="">Seleccione un Cubículo</option>
                    </select>
                </div>

                <!-- Botón de Mostrar Resultados -->
                <button id="mostrarResultados" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition mt-4">
                    Mostrar Resultados
                </button>
            </div>

            <!-- Sección de Resultados -->
            <div id="resultado" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-6 hidden">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Resultados Seleccionados</h3>
                <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300">
                    <li><strong>Departamento:</strong> <span id="selected-departamento">N/A</span></li>
                    <li><strong>Área:</strong> <span id="selected-area">N/A</span></li>
                    <li><strong>Ubicación:</strong> <span id="selected-ubicacion">N/A</span></li>
                    <li><strong>Cubículo:</strong> <span id="selected-cubiculo">N/A</span></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- JavaScript para manejar el filtrado con AJAX -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const departamentoSelect = document.getElementById('departamento');
            const areaSelect = document.getElementById('area');
            const ubicacionSelect = document.getElementById('ubicacion');
            const cubiculoSelect = document.getElementById('cubiculo');

            const resultado = document.getElementById('resultado');
            const selectedDepartamento = document.getElementById('selected-departamento');
            const selectedArea = document.getElementById('selected-area');
            const selectedUbicacion = document.getElementById('selected-ubicacion');
            const selectedCubiculo = document.getElementById('selected-cubiculo');

            function toggleSelect(selectElement, enable) {
                selectElement.disabled = !enable;
            }

            function clearSelect(selectElement, placeholder = "Seleccione una opción") {
                selectElement.innerHTML = `<option value="">${placeholder}</option>`;
            }

            function updateResultDisplay() {
                selectedDepartamento.textContent = departamentoSelect.options[departamentoSelect.selectedIndex]?.text || "N/A";
                selectedArea.textContent = areaSelect.options[areaSelect.selectedIndex]?.text || "N/A";
                selectedUbicacion.textContent = ubicacionSelect.options[ubicacionSelect.selectedIndex]?.text || "N/A";
                selectedCubiculo.textContent = cubiculoSelect.options[cubiculoSelect.selectedIndex]?.text || "N/A";
                resultado.classList.remove('hidden');
            }

            departamentoSelect.addEventListener('change', function() {
                const departamentoId = this.value;
                if (departamentoId) {
                    fetch(`/tecnico/filtrar-areas?departamento_id=${departamentoId}`)
                        .then(response => response.ok ? response.json() : Promise.reject('Error al obtener las áreas'))
                        .then(data => {
                            clearSelect(areaSelect, "Seleccione un Área");
                            toggleSelect(areaSelect, data.areas.length > 0);
                            data.areas.forEach(area => {
                                const option = document.createElement('option');
                                option.value = area.id_area;
                                option.textContent = area.nombre_area;
                                areaSelect.appendChild(option);
                            });
                            clearSelect(ubicacionSelect);
                            toggleSelect(ubicacionSelect, false);
                            clearSelect(cubiculoSelect);
                            toggleSelect(cubiculoSelect, false);
                            updateResultDisplay();
                        })
                        .catch(() => alert('Hubo un problema al cargar las áreas.'));
                } else {
                    clearSelect(areaSelect);
                    toggleSelect(areaSelect, false);
                    clearSelect(ubicacionSelect);
                    toggleSelect(ubicacionSelect, false);
                    clearSelect(cubiculoSelect);
                    toggleSelect(cubiculoSelect, false);
                    updateResultDisplay();
                }
            });

            areaSelect.addEventListener('change', function() {
                const areaId = this.value;
                if (areaId) {
                    fetch(`/tecnico/filtrar-ubicaciones?area_id=${areaId}`)
                        .then(response => response.ok ? response.json() : Promise.reject('Error al obtener las ubicaciones'))
                        .then(data => {
                            clearSelect(ubicacionSelect, "Seleccione una Ubicación");
                            toggleSelect(ubicacionSelect, data.ubicaciones.length > 0);
                            data.ubicaciones.forEach(ubicacion => {
                                const option = document.createElement('option');
                                option.value = ubicacion.id_ubicacion;
                                option.textContent = ubicacion.nombre_ubicacion;
                                ubicacionSelect.appendChild(option);
                            });
                            clearSelect(cubiculoSelect);
                            toggleSelect(cubiculoSelect, false);
                            updateResultDisplay();
                        })
                        .catch(() => alert('Hubo un problema al cargar las ubicaciones.'));
                } else {
                    clearSelect(ubicacionSelect);
                    toggleSelect(ubicacionSelect, false);
                    clearSelect(cubiculoSelect);
                    toggleSelect(cubiculoSelect, false);
                    updateResultDisplay();
                }
            });

            ubicacionSelect.addEventListener('change', function() {
                const ubicacionId = this.value;
                if (ubicacionId) {
                    fetch(`/tecnico/filtrar-cubiculos?ubicacion_id=${ubicacionId}`)
                        .then(response => response.ok ? response.json() : Promise.reject('Error al obtener los cubículos'))
                        .then(data => {
                            clearSelect(cubiculoSelect, "Seleccione un Cubículo");
                            toggleSelect(cubiculoSelect, data.cubiculos.length > 0);
                            data.cubiculos.forEach(cubiculo => {
                                const option = document.createElement('option');
                                option.value = cubiculo.id_cubiculo;
                                option.textContent = cubiculo.numero_cubiculo;
                                cubiculoSelect.appendChild(option);
                            });
                            updateResultDisplay();
                        })
                        .catch(() => alert('Hubo un problema al cargar los cubículos.'));
                } else {
                    clearSelect(cubiculoSelect);
                    toggleSelect(cubiculoSelect, false);
                    updateResultDisplay();
                }
            });

            cubiculoSelect.addEventListener('change', updateResultDisplay);
        });
    </script>
</x-app-layout>
