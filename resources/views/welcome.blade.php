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
    <header class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-5 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">GabDesk</h1>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded-md shadow hover:bg-gray-200 transition duration-200">Iniciar Sesión</a>
                {{-- <a href="{{ route('register') }}" class="bg-blue-700 px-4 py-2 rounded-md shadow hover:bg-blue-800 transition duration-200">Registrarse</a> --}}
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto py-10 px-4 lg:px-0">
        <div class="text-center">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">Bienvenido a GabDesk</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-12">Tu mesa de ayuda eficiente y organizada para problemas técnicos y de equipo.</p>
        </div>

        <!-- Interactive Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1: Soporte de Tickets -->
            <div onclick="showInfo('support')" class="group relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 cursor-pointer">
                <div class="h-64 w-full">
                    <img src="{{ asset('img/soporte.jpg') }}" alt="Ticket Support" class="h-full w-full object-cover object-center">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-xl font-bold text-gray-800">Soporte de Tickets</h3>
                    <p class="text-gray-600">Crea y gestiona tickets de soporte técnico para tus problemas.</p>
                </div>
                <!-- Overlay -->
                <div class="absolute inset-0 bg-blue-600 bg-opacity-0 group-hover:bg-opacity-20 transition duration-300"></div>
            </div>

            <!-- Card 2: Admin -->
            <div onclick="showInfo('admin')" class="group relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 cursor-pointer">
                <div class="h-64 w-full">
                    <img src="{{ asset('img/admin.jpg') }}" alt="Admin Panel" class="h-full w-full object-cover object-center">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-xl font-bold text-gray-800">Admin</h3>
                    <p class="text-gray-600">Accede al panel de administración para gestionar usuarios y configuraciones.</p>
                </div>
                <div class="absolute inset-0 bg-blue-600 bg-opacity-0 group-hover:bg-opacity-20 transition duration-300"></div>
            </div>

            <!-- Card 3: Solución de Equipos -->
            <div onclick="showInfo('equipment')" class="group relative bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 cursor-pointer">
                <div class="h-64 w-full">
                    <img src="{{ asset('img/equipos.jpg') }}" alt="Solución de Equipos" class="h-full w-full object-cover object-center">
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-xl font-bold text-gray-800">Solución de Equipos</h3>
                    <p class="text-gray-600">Soluciona problemas de hardware y equipos con nuestras guías y soporte.</p>
                </div>
                <div class="absolute inset-0 bg-blue-600 bg-opacity-0 group-hover:bg-opacity-20 transition duration-300"></div>
            </div>
        </div>

        <!-- Dynamic Content Modal -->
        <div id="infoModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-2/3 lg:w-1/2">
                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800">&times;</button>
                <h3 id="modalTitle" class="text-2xl font-bold mb-4 text-blue-600"></h3>
                <p id="modalContent" class="text-gray-700"></p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 text-center">
        <p>&copy; 2024 GabDesk. Todos los derechos reservados.</p>
    </footer>

    <!-- JavaScript for AJAX and Modal -->
    <script>
        function showInfo(section) {
            // Mapeo de contenido de ejemplo para cada sección
            const content = {
                'support': {
                    title: 'Soporte de Tickets',
                    text: 'Aquí puedes crear y gestionar todos tus tickets de soporte. El equipo está listo para ayudarte con cualquier inconveniente técnico.'
                },
                'admin': {
                    title: 'Admin',
                    text: 'El panel de administración te permite gestionar usuarios, roles, y configuraciones de la plataforma de manera sencilla.'
                },
                'equipment': {
                    title: 'Solución de Equipos',
                    text: 'Encuentra guías y soporte para resolver problemas de hardware y mantener tus equipos en óptimas condiciones.'
                }
            };

            // Insertar datos en el modal
            document.getElementById('modalTitle').innerText = content[section].title;
            document.getElementById('modalContent').innerText = content[section].text;

            // Mostrar el modal
            document.getElementById('infoModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('infoModal').classList.add('hidden');
        }
    </script>
</body>
</html>
