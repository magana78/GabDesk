        <!-- resources/views/components/navbar.blade.php -->
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-300 fixed top-0 w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo dinámico según el rol -->
                        <div class="shrink-0 flex items-center">
                            @if (Auth::user()->hasRole('Administrador'))
                                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 font-bold text-lg">
                                    <img src="{{ asset('img/Gabdesk.png') }}" class="h-9 w-auto" alt="Logo Gabdesk">
                                </a>
                            @elseif (Auth::user()->hasRole('Técnico de soporte'))
                                <a href="{{ route('tecnico.dashboard') }}" class="text-blue-600 font-bold text-lg">
                                    <img src="{{ asset('img/Gabdesk.png') }}" class="h-9 w-auto" alt="Logo Gabdesk">
                                </a>
                            @endif
                        </div>

                        <!-- Enlaces de navegación según el rol -->
                        <div class="hidden md:flex space-x-8 ml-10">
                            @if (Auth::user()->hasRole('Administrador'))
                                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-gray-600 hover:text-blue-600">
                                    {{ __('Dashboard de Administración') }}
                                </x-nav-link>
                            @elseif (Auth::user()->hasRole('Técnico de soporte'))
                                <x-nav-link :href="route('tecnico.dashboard')" :active="request()->routeIs('tecnico.dashboard')" class="text-gray-600 hover:text-blue-600">
                                    {{ __('Dashboard Técnico de Soporte') }}
                                </x-nav-link>
                            @endif
                        </div>
                    </div>

                    <!-- Dropdown de configuración -->
                    <x-user-settings-dropdown alignment="right" />
                </div>
            </div>
        </nav>
