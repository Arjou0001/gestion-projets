<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-7xl mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <!-- Bouton pour revenir au dashboard -->
            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Menu
            </a>

            <!-- Bouton pour revenir à la page précédente -->
            <button onclick="history.back()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Revenir
            </button>
        </div>

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
