<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GabDesk - Dashboard</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-blue-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-semibold">GabDesk</h1>
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded-md shadow hover:bg-gray-200">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="bg-blue-500 px-4 py-2 rounded-md shadow hover:bg-blue-700">Registrarse</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 container mx-auto py-10">
            <h2 class="text-2xl font-bold text-center mb-6">Bienvenido a GabDesk</h2>
            <p class="text-center text-gray-700 mb-12">Tu mesa de ayuda eficiente y organizada.</p>

            <!-- Interactive Image Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Interactive Image 1: Soporte de Tickets -->
                <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 w-full"> <!-- Asegurando una altura consistente -->
                        <img src="{{ asset('img/soporte.jpg') }}" alt="Ticket Support" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Soporte de Tickets</h3>
                        <p class="text-gray-600">Crea y gestiona tickets de soporte técnico para tus problemas.</p>
                    </div>
                    <a href="#" class="absolute inset-0 bg-blue-600 bg-opacity-0 hover:bg-opacity-20 transition duration-300"></a>
                </div>

                <!-- Interactive Image 2: Admin -->
                <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 w-full"> <!-- Asegurando una altura consistente -->
                        <img src="{{ asset('img/admin.jpg') }}" alt="Admin Panel" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Admin</h3>
                        <p class="text-gray-600">Accede al panel de administración para gestionar usuarios y configuraciones.</p>
                    </div>
                    <a href="#" class="absolute inset-0 bg-blue-600 bg-opacity-0 hover:bg-opacity-20 transition duration-300"></a>
                </div>

                <!-- Interactive Image 3: Solución de Equipos -->
                <div class="relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 w-full"> <!-- Asegurando una altura consistente -->
                        <img src="{{ asset('img/equipos.jpg') }}" alt="Solución de Equipos" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold">Solución de Equipos</h3>
                        <p class="text-gray-600">Soluciona problemas de hardware y equipos con nuestras guías y soporte.</p>
                    </div>
                    <a href="#" class="absolute inset-0 bg-blue-600 bg-opacity-0 hover:bg-opacity-20 transition duration-300"></a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white p-4 text-center">
            <p>&copy; 2024 GabDesk. Todos los derechos reservados.</p>
        </footer>

    </body>
</html>
