<button {{ $attributes->merge(['class' => 'w-full justify-center mt-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600']) }}>
    {{ $slot }}
</button>
