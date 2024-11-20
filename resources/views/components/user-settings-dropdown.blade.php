@props(['alignment' => 'right'])

<x-dropdown :align="$alignment" width="48">
    <x-slot name="trigger">
        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-semibold leading-5 rounded-md text-gray-900 bg-gray-100 dark:text-gray-200 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
            <div class="flex flex-col text-left">
                <span>{{ Auth::user()->nombre }}</span> <!-- Nombre del usuario -->
                <span class="text-xs text-indigo-500 dark:text-indigo-400">({{ Auth::user()->roles->pluck('nombre_rol')->first() }})</span> <!-- Primer rol del usuario -->
            </div>
            <div class="ml-2">
                <svg class="fill-current h-5 w-5 text-indigo-500 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        <!-- Divider with Title -->
        <div class="px-4 py-2 bg-indigo-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-sm font-semibold">
            {{ __('Configuración de Usuario') }}
        </div>

        <!-- Enlace al perfil del usuario -->
        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 text-gray-900 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 transition">
            <svg class="h-5 w-5 text-indigo-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.969 7.969 0 0012 20a7.969 7.969 0 006.879-3.804M15 11a3 3 0 11-6 0 3 3 0 016 0zM4 6a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V6z" />
            </svg>
            {{ __('Perfil') }}
        </x-dropdown-link>

        <!-- Divider Line -->
        <div class="border-t border-gray-100 dark:border-gray-700 my-2"></div>

        <!-- Cerrar Sesión -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" 
                             class="flex items-center px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-700 transition"
                             onclick="event.preventDefault(); this.closest('form').submit();">
                <svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m-6-4a6 6 0 110-12 6 6 0 010 12zm12 0v1" />
                </svg>
                {{ __('Cerrar Sesión') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
        