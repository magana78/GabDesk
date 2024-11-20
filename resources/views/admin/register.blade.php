<x-navbar />

<x-guest-layout>

    <!-- Contenedor de bienvenida -->
    <div class="flex flex-col items-center mt-6">
        <img src="{{ asset('img/gabdesk_logo5.webp') }}" alt="Gabdesk Logo" class="h-24 w-24 rounded-full shadow-lg">
        <h2 class="text-center text-2xl font-bold text-gray-800 dark:text-gray-200 mt-4">Crear una Cuenta en Gabdesk</h2>
        <p class="text-center text-gray-500 dark:text-gray-400 mt-1">Por favor, completa el formulario para registrarte</p>
    </div>

    <!-- Formulario de registro -->
    <form method="POST" action="{{ route('admin.register.store') }}" class="mt-6 max-w-lg mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
        @csrf

        <!-- Campo de Nombre -->
        <div class="mt-4">
            <x-input-label for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" type="text" name="nombre" :value="old('nombre')" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required autofocus />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Campo de Correo Electrónico -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Campo de Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" type="password" name="password" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmación de Contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Campo de Estado -->
        <div class="mt-4">
            <x-input-label for="estado" :value="__('Estado')" />
            <select id="estado" name="estado" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>{{ __('Activo') }}</option>
                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>{{ __('Inactivo') }}</option>
            </select>
            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
        </div>

        <!-- Campo de Selección de Rol -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Tipo de Cuenta')" />
            <select name="role" id="role" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                <option value="">{{ __('--Selecciona un Rol--') }}</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->nombre_rol }}" {{ old('role') == $role->nombre_rol ? 'selected' : '' }}>{{ $role->nombre_rol }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Campo de Selección de Departamento -->
        <div class="mt-4">
            <x-input-label for="id_departamento" :value="__('Departamento')" />
            <select id="id_departamento" name="id_departamento" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
                <option value="">{{ __('Seleccione un departamento') }}</option>
                @foreach($departamentos as $departamento)
                    <option value="{{ $departamento->id_departamento }}" {{ old('id_departamento') == $departamento->id_departamento ? 'selected' : '' }}>{{ $departamento->nombre_departamento }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('id_departamento')" class="mt-2" />
        </div>

        <!-- Campo de Selección de Área -->
        <div class="mt-4">
            <x-input-label for="id_area" :value="__('Área')" />
            <select id="id_area" name="id_area" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required disabled>
                <option value="">{{ __('Seleccione un área') }}</option>
            </select>
            <x-input-error :messages="$errors->get('id_area')" class="mt-2" />
        </div>

        <!-- Campo de Selección de Ubicación -->
        <div class="mt-4">
            <x-input-label for="id_ubicacion" :value="__('Ubicación')" />
            <select id="id_ubicacion" name="id_ubicacion" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required disabled>
                <option value="">{{ __('Seleccione una ubicación') }}</option>
            </select>
            <x-input-error :messages="$errors->get('id_ubicacion')" class="mt-2" />
        </div>

        <!-- Campo de Selección de Cubículo -->
        <div class="mt-4">
            <x-input-label for="id_cubiculo" :value="__('Cubículo')" />
            <select id="id_cubiculo" name="id_cubiculo" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required disabled>
                <option value="">{{ __('Seleccione un cubículo') }}</option>
            </select>
            <x-input-error :messages="$errors->get('id_cubiculo')" class="mt-2" />
        </div>

        <!-- Botón de Registro -->
        <div class="mt-6">
            <x-primary-button class="w-full">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Scripts para manejo dinámico de selects -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            console.log('JavaScript cargado correctamente.');
            // Lógica para manejo dinámico de selects (igual que antes)
            $('#id_departamento').on('change', function() {
                const departamentoId = $(this).val();
                $('#id_area').prop('disabled', true).html('<option value="">{{ __("Seleccione un área") }}</option>');
                $('#id_ubicacion').prop('disabled', true).html('<option value="">{{ __("Seleccione una ubicación") }}</option>');
                $('#id_cubiculo').prop('disabled', true).html('<option value="">{{ __("Seleccione un cubículo") }}</option>');
                if (departamentoId) {
                    $.ajax({
                        url: `admin/ajax/areas/${departamentoId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            const areaSelect = $('#id_area');
                            areaSelect.html('<option value="">{{ __("Seleccione un área") }}</option>');
                            $.each(data, function(index, area) {
                                areaSelect.append(`<option value="${area.id_area}">${area.nombre_area}</option>`);
                            });
                            areaSelect.prop('disabled', false);
                        },
                        error: function() {
                            alert('{{ __("Ocurrió un error al cargar las áreas.") }}');
                        }
                    });
                }
            });

            $('#id_area').on('change', function() {
                const areaId = $(this).val();
                $('#id_ubicacion').prop('disabled', true).html('<option value="">{{ __("Seleccione una ubicación") }}</option>');
                $('#id_cubiculo').prop('disabled', true).html('<option value="">{{ __("Seleccione un cubículo") }}</option>');
                if (areaId) {
                    $.ajax({
                        url: `admin/ajax/ubicaciones/${areaId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            const ubicacionSelect = $('#id_ubicacion');
                            ubicacionSelect.html('<option value="">{{ __("Seleccione una ubicación") }}</option>');
                            $.each(data, function(index, ubicacion) {
                                ubicacionSelect.append(`<option value="${ubicacion.id_ubicacion}">${ubicacion.nombre_ubicacion}</option>`);
                            });
                            ubicacionSelect.prop('disabled', false);
                        },
                        error: function() {
                            alert('{{ __("Ocurrió un error al cargar las ubicaciones.") }}');
                        }
                    });
                }
            });

            $('#id_ubicacion').on('change', function() {
                const ubicacionId = $(this).val();
                $('#id_cubiculo').prop('disabled', true).html('<option value="">{{ __("Seleccione un cubículo") }}</option>');
                if (ubicacionId) {
                    $.ajax({
                        url: `admin/ajax/cubiculos/${ubicacionId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            const cubiculoSelect = $('#id_cubiculo');
                            cubiculoSelect.html('<option value="">{{ __("Seleccione un cubículo") }}</option>');
                            $.each(data, function(index, cubiculo) {
                                cubiculoSelect.append(`<option value="${cubiculo.id_cubiculo}">${cubiculo.numero_cubiculo}</option>`);
                            });
                            cubiculoSelect.prop('disabled', false);
                        },
                        error: function() {
                            alert('{{ __("Ocurrió un error al cargar los cubículos.") }}');
                        }
                    });
                }
            });

            @if (session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            @endif
        });
    </script>
</x-guest-layout>
