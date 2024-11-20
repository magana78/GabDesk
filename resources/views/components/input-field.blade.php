@props(['label', 'name', 'type' => 'text', 'placeholder' => ''])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}" {{ $attributes->merge(['class' => 'block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-800 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-lg']) }}>
</div>
