<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-10 px-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier le projet : {{ $projet->nom }}</h2>

            <form action="{{ route('projets.update', $projet->id) }}" method="POST" class="bg-white shadow-md rounded-2xl p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                    <input type="text" name="nom" id="nom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nom', $projet->nom) }}">
                    @error('nom') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="duree" class="block text-gray-700 text-sm font-bold mb-2">Durée (jours)</label>
                    <input type="number" name="duree" id="duree" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('duree', $projet->duree) }}">
                    @error('duree') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="budget" class="block text-gray-700 text-sm font-bold mb-2">Budget</label>
                    <input type="number" name="budget" id="budget" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('budget', $projet->budget) }}">
                    @error('budget') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="nombre_personnes" class="block text-gray-700 text-sm font-bold mb-2">Nombre de personnes</label>
                    <input type="number" name="nombre_personnes" id="nombre_personnes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nombre_personnes', $projet->nombre_personnes) }}">
                    @error('nombre_personnes') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="entreprise_id" class="block text-gray-700 text-sm font-bold mb-2">Entreprise</label>
                    <select name="entreprise_id" id="entreprise_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($entreprises as $entreprise)
                            <option value="{{ $entreprise->id }}" {{ old('entreprise_id', $projet->entreprise_id) == $entreprise->id ? 'selected' : '' }}>
                                {{ $entreprise->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('entreprise_id') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Mettre à jour
                    </button>
                    <a href="{{ route('projets.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </x-slot>
</x-app-layout>