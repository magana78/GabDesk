<x-guest-layout>
    <!-- Contenedor principal con animación fade-in -->
    <div class="flex flex-col items-center mt-8 space-y-4 animate-fade-in">
        <!-- Logo centrado -->
        <img src="{{ asset('img/Gabdesk.png') }}" alt="Gabdesk Logo" class="h-28 w-28 rounded-full shadow-lg">

        <!-- Título de bienvenida -->
        <h2 class="text-center text-3xl font-extrabold text-indigo-700 dark:text-indigo-400 mt-4">
            Bienvenido a Gabdesk
        </h2>
        <p class="text-center text-gray-500 dark:text-gray-400">
            Por favor, inicia sesión para continuar
        </p>
    </div>

    <!-- Contenedor del formulario con fondo y sombras -->
    <div class="max-w-md mx-auto mt-6">
        <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-xl transition-transform duration-300 hover:shadow-2xl hover:scale-105 relative">
            @csrf

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Campo de Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full mt-2 p-2 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Campo de Password con toggle de visibilidad -->
            <div class="mb-4 relative">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block w-full mt-2 p-2 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="password" name="password" required autocomplete="current-password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword()">
                    <!-- Icono ojo para mostrar/ocultar contraseña -->
                    <svg id="showIcon" class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-7.07 6.09a10 10 0 01-.68-.72m1.64 1.34a9 9 0 0112.72 0M12 20a9 9 0 018.84-6.92M15.44 9.9a9 9 0 00-3.76-7.45"></path>
                    </svg>
                </button>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Recordarme y enlace a restablecer contraseña -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordarme') }}</span>
                </label>

                <x-link :href="route('password.request')" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                    ¿Olvidaste tu contraseña?
                </x-link>
            </div>

            <!-- Botón de Iniciar Sesión con efecto de hover y loader -->
            <x-primary-button id="submitButton" class="w-full mt-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 transition-transform duration-300 hover:scale-105 flex items-center justify-center">
                <span id="buttonText">{{ __('Iniciar Sesión') }}</span>
                <span id="buttonSpinner" class="hidden animate-spin ml-2">
                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 4v4m0 8v4m4-8h4m-8 0H4m6.343-6.343l2.828 2.828M17.657 17.657l-2.828-2.828M4 4l2.828 2.828m12.828 12.828L17.657 17.657"></path>
                    </svg>
                </span>
            </x-primary-button>

            <!-- Alternativas de inicio de sesión con redes sociales -->
            <div class="flex justify-center mt-6 space-x-4">
                <!-- Botón Google -->
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M21.35 11.1h-9.4v3.6h5.5c-.3 1.8-1.6 3.3-3.3 3.8v3.1h5.3c3.1-2.8 3.9-6.8 3.9-7.5 0-.7-.1-1.4-.2-2z" fill="#4285F4"/>
                        <path d="M12 24c-3.3 0-6.4-1.2-8.8-3.5l3.4-3.2c2.2 1.5 4.7 2.4 7.5 2.4 2.9 0 5.3-1 7-2.7 1-1 1.7-2.4 2.1-4h-5.5v-3.6h9.4c.1.6.1 1.3.1 2 0 4.7-3.2 8.1-7.5 8.1z" fill="#34A853"/>
                        <path d="M3.2 11.1c.5-1.5 1.5-2.8 2.7-3.8l-3.4-3.3C1.3 6.7 0 9.2 0 12c0 2.7 1.3 5.2 3.5 6.9l3.4-3.3c-.6-1.3-1.1-2.7-1.1-4.5z" fill="#FBBC05"/>
                        <path d="M12 4.8c1.6 0 3.1.5 4.2 1.4l3.1-3.1C17.7 1.3 14.9 0 12 0 7.9 0 4.4 2.2 2.6 5.2l3.4 3.2C7.3 6 9.5 4.8 12 4.8z" fill="#EA4335"/>
                    </svg>
                    Google
                </button>
                <!-- Botón Facebook -->
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M22.68 0H1.32C.59 0 0 .59 0 1.32v21.36c0 .73.59 1.32 1.32 1.32h11.48V14.7h-3.1v-3.6h3.1V8.7c0-3.07 1.87-4.76 4.6-4.76 1.31 0 2.44.1 2.77.14v3.21h-1.9c-1.49 0-1.77.71-1.77 1.74v2.28h3.54l-.46 3.6h-3.08V24h6.03c.73 0 1.32-.59 1.32-1.32V1.32c0-.73-.59-1.32-1.32-1.32z"/>
                    </svg>
                    Facebook
                </button>
            </div>

            <!-- Mensaje de estado AJAX -->
            <div id="statusMessage" class="mt-4 text-center"></div>
        </form>
    </div>

    <!-- Script para AJAX, toggle de contraseña y validación -->
    <script>
      document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Muestra el spinner en el botón
    document.getElementById('buttonText').classList.add('hidden');
    document.getElementById('buttonSpinner').classList.remove('hidden');

    // Muestra mensaje de carga
    const statusMessage = document.getElementById('statusMessage');
    statusMessage.innerHTML = '<span class="text-indigo-600 dark:text-indigo-400 font-semibold">Procesando...</span>';

    // Recopila datos del formulario
    const formData = new FormData(this);

    // Realiza la solicitud AJAX
    fetch('{{ route('login') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.ok ? response.json() : Promise.reject(response))
    .then(data => {
        // Verifica el rol y redirige según corresponda
        if (data.role === 'Administrador') {
            window.location.href = "{{ route('admin.dashboard') }}";
        } else if (data.role === 'Tecnico') {
            window.location.href = "{{ route('tecnico.dashboard') }}";
        } 
        } else {
            // En caso de que no haya rol válido
            statusMessage.innerHTML = '<span class="text-red-600 dark:text-red-400">No tienes permisos para acceder.</span>';
            document.getElementById('buttonText').classList.remove('hidden');
            document.getElementById('buttonSpinner').classList.add('hidden');
        }
    })
    .catch(error => {
        // Maneja errores de autenticación
        if (error.json) {
            error.json().then(data => {
                let errors = Object.values(data.errors || {}).flat().join('<br>');
                statusMessage.innerHTML = `<span class="text-red-600 dark:text-red-400">${errors}</span>`;
            });
        } else {
            statusMessage.innerHTML = '<span class="text-red-600 dark:text-red-400">Ocurrió un error inesperado. Inténtalo nuevamente.</span>';
        }

        document.getElementById('buttonText').classList.remove('hidden');
        document.getElementById('buttonSpinner').classList.add('hidden');
    });
});

    </script>
</x-guest-layout>
