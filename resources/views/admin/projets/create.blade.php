<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un Nouveau Projet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Informations du Projet') }}</h3>

                    <form method="POST" action="{{ route('admin.projets.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="nom" class="block text-gray-700 font-medium mb-2">{{ __('Nom du Projet') }}</label>
                            <input type="text" name="nom" id="nom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="duree" class="block text-gray-700 font-medium mb-2">{{ __('Durée (en jours)') }}</label>
                            <input type="number" name="duree" id="duree" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('duree') }}" required min="1">
                            @error('duree')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="budget" class="block text-gray-700 font-medium mb-2">{{ __('Budget') }}</label>
                            <input type="number" name="budget" id="budget" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('budget') }}" required min="1">
                            @error('budget')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nombre_personnes" class="block text-gray-700 font-medium mb-2">{{ __('Nombre de Personnes') }}</label>
                            <input type="number" name="nombre_personnes" id="nombre_personnes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nombre_personnes') }}" required min="1">
                            @error('nombre_personnes')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="entreprise_id" class="block text-gray-700 font-medium mb-2">{{ __('Entreprise Associée') }}</label>
                            <select name="entreprise_id" id="entreprise_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">{{ __('Sélectionner une entreprise') }}</option>
                                @foreach ($entreprises as $entreprise)
                                    <option value="{{ $entreprise->id }}" {{ old('entreprise_id') == $entreprise->id ? 'selected' : '' }}>{{ $entreprise->nom }}</option>
                                @endforeach
                            </select>
                            @error('entreprise_id')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="projet_possible_id" class="block text-gray-700 font-medium mb-2">{{ __('Modèle de Projet (Optionnel)') }}</label>
                            <select name="projet_possible_id" id="projet_possible_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">{{ __('Sélectionner un modèle de projet') }}</option>
                                @foreach ($projetsPossibles as $projetPossible)
                                    <option value="{{ $projetPossible->id }}" {{ old('projet_possible_id') == $projetPossible->id ? 'selected' : '' }}>{{ $projetPossible->nom }} ({{ $projetPossible->nature }})</option>
                                @endforeach
                            </select>
                            @error('projet_possible_id')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="1" checked>
                                <span class="ml-2 text-gray-700">{{ __('Actif') }}</span>
                            </label>
                            @error('is_active')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Créer le Projet') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>