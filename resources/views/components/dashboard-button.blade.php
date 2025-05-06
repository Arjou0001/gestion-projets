@props(['route', 'color' => 'blue'])

@php
    $colors = [
        'red' => 'bg-red-600 hover:bg-red-700',
        'yellow' => 'bg-yellow-600 hover:bg-yellow-700',
        'purple' => 'bg-purple-600 hover:bg-purple-700',
        'green' => 'bg-green-600 hover:bg-green-700',
        'blue' => 'bg-blue-600 hover:bg-blue-700',
        'indigo' => 'bg-indigo-600 hover:bg-indigo-700',
        'gray' => 'bg-gray-600 hover:bg-gray-700',
    ];

    $selectedColor = $colors[$color] ?? $colors['blue'];
@endphp

<a href="{{ route($route) }}" class="{{ $selectedColor }} text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
    {{ $slot }}
</a>
