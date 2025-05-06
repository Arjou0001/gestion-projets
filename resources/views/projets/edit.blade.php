<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Modifier le projet : {{ $projet->nom }}</h2>

            <form action="{{ route('projets.update', $projet->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="nom" class="block font-medium text-gray-700 mb-1">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $projet->nom) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                    @error('nom') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="duree" class="block font-medium text-gray-700 mb-1">Durée (jours)</label>
                    <input type="number" name="duree" id="duree" value="{{ old('duree', $projet->duree) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                    @error('duree') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="budget" class="block font-medium text-gray-700 mb-1">Budget</label>
                    <input type="number" name="budget" id="budget" value="{{ old('budget', $projet->budget) }}"
                        step="0.01"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                    @error('budget') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="nombre_personnes" class="block font-medium text-gray-700 mb-1">Nombre de personnes</label>
                    <input type="number" name="nombre_personnes" id="nombre_personnes" value="{{ old('nombre_personnes', $projet->nombre_personnes) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                    @error('nombre_personnes') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="entreprise_id" class="block font-medium text-gray-700 mb-1">Entreprise</label>
                    <select name="entreprise_id" id="entreprise_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                        @foreach ($entreprises as $entreprise)
                            <option value="{{ $entreprise->id }}" {{ old('entreprise_id', $projet->entreprise_id) == $entreprise->id ? 'selected' : '' }}>
                                {{ $entreprise->nom }} ({{ $entreprise->nature }})
                            </option>
                        @endforeach
                    </select>
                    @error('entreprise_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                        Mettre à jour
                    </button>
                    <a href="{{ route('projets.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-200">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
