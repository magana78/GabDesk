@props(['icon', 'href' => '#'])

<a href="{{ $href }}" class="text-indigo-600 hover:text-indigo-800">
    <i class="fab fa-{{ $icon }} fa-lg"></i>
</a>
