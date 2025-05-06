<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gestion de Projets et Entreprises</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Créer un compte
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Bienvenue sur notre plateforme de gestion de projets et création d'entreprises</h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">Transformez vos idées en réalité avec une gestion de projets fluide et la possibilité de créer et gérer votre propre entreprise en quelques clics.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-8 text-center">
            <div class="flex-1 p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-gray-800">Créer une entreprise</h3>
                <p class="mt-4 text-gray-600">Démarrez facilement et gérez toutes les étapes de la création de votre entreprise en ligne.</p>
                <a href="{{ route('entreprises.create') }}" class="mt-6 inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Démarrer</a>
            </div>

            <div class="flex-1 p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-gray-800">Gérer vos projets</h3>
                <p class="mt-4 text-gray-600">Planifiez, suivez et gérez vos projets de manière efficace, de la création à la finalisation.</p>
                <a href="{{ route('projets.create') }}" class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Créer un projet</a>
            </div>
        </div>

        <div class="mt-12 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Votre tableau de bord</h2>
            <p class="mt-4 text-lg text-gray-600">Accédez à toutes vos entreprises et projets en un seul endroit, et gérez-les facilement.</p>
            <a href="{{ url('/dashboard') }}" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Accéder au tableau de bord</a>
        </div>
    </body>
</html>
